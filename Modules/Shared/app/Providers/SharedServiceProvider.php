<?php

namespace Modules\Shared\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Nwidart\Modules\Traits\PathNamespace;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

use Modules\Shared\Services\LookupRegistry;
use Modules\Shared\Services\BarricadeRegistry;

use Illuminate\Database\Eloquent\Relations\Relation;

use Modules\Shared\Services\OnlinePayments\RazorpayService;

use Modules\Shared\Barricade\SharedBarricadeResources;
use Modules\Shared\Services\OnlinePayments\PayableResolver;

class SharedServiceProvider extends ServiceProvider
{
    use PathNamespace;

    protected string $name = 'Shared';

    protected string $nameLower = 'shared';

    /**
     * Boot the application events.
     */
    public function boot(): void
    {
        $this->registerCommands();
        $this->registerCommandSchedules();
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->name, 'database/migrations'));

		// Lookups
		$this->loadPhpLookupsFromModules(); // Registers all lookup keys returning static values
		$this->loadDynamicLookupsFromProviders(); // Register all lookup keys wherein we fetch dynamic values

		// Barricades
	    SharedBarricadeResources::register(); // Shared module barricade resources
		$this->loadBarricadeRulesFromModules(); // Register barricade rules from all modules

		// Online Payment Services
		$this->app->singleton(RazorpayService::class, function () {
            return new RazorpayService();
        });
		$this->app->singleton(PayableResolver::class);

		// Loading Plesk API to create/delete databases for tenants
		$this->mergeConfigFrom(
		    module_path('Shared', 'config/plesk.php'),
    		'plesk'
		);

		// Loading Email templates
		$this->loadViewsFrom(
			module_path('Shared', 'resources/views'),
        	'shared'
    	);

		// Morph map registrations
		Relation::morphMap([
            'employee' => \Modules\Employee\Models\Employee::class
        ]);
    }

	// Registers all lookup keys returning static values
	protected function loadPhpLookupsFromModules()
	{
    	$modulePath = base_path('Modules');

	    foreach (scandir($modulePath) as $module) {
    	    if ($module === '.' || $module === '..') continue;

        	$lookupFile = $modulePath . "/{$module}/lookups.php";

	        if (file_exists($lookupFile)) {
    	        $lookups = require $lookupFile;

	            foreach ($lookups as $key => $value) {
    	            LookupRegistry::register($key, $value);
        	    }
        	}
    	}
	}

	// Register all lookup keys wherein we fetch dynamic values
	protected function loadDynamicLookupsFromProviders()
	{
    	$modulePath = base_path('Modules');

	    foreach (scandir($modulePath) as $module) {
    	    if ($module === '.' || $module === '..') continue;

	        $providerClass = "Modules\\{$module}\\Providers\\{$module}LookupProvider";

	        if (!class_exists($providerClass)) {
    	        continue;
        	}

	        // ✅ ALWAYS use container
    	    $provider = app($providerClass);

	        // 1️⃣ Normal lookup registration
    	    if (method_exists($provider, 'getLookups')) {
        	    foreach ($provider->getLookups() as $key => $value) {
            	    LookupRegistry::register($key, $value);
            	}
        	}

	        // 2️⃣ 🔥 FALLBACK registration (THIS WAS MISSING)
    	    if (method_exists($provider, 'register')) {
        	    $provider->register();
        	}
    	}
	}

	/**
	 * Register barricade rules from all modules
	 */
	protected function loadBarricadeRulesFromModules(): void
	{
	    $modulePath = base_path('Modules');

	    foreach (scandir($modulePath) as $module) {
    	    if ($module === '.' || $module === '..') {
        	    continue;
        	}

	        $barricadeFile = $modulePath . "/{$module}/barricade.php";

	        if (!file_exists($barricadeFile)) {
    	        continue;
        	}

            $rules = require $barricadeFile;

	        if (!is_array($rules)) {
    	        continue;
        	}

	        foreach ($rules as $route => $definitions) {
    	        BarricadeRegistry::register($route, $definitions);
        	}
    	}
	}

    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->app->register(EventServiceProvider::class);
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register commands in the format of Command::class
     */
    protected function registerCommands(): void
    {
        $this->commands([
			\Modules\Shared\Console\SyncScheduleJobs::class
		]);
    }

    /**
     * Register command Schedules.
     */
    protected function registerCommandSchedules(): void
    {
        // $this->app->booted(function () {
        //     $schedule = $this->app->make(Schedule::class);
        //     $schedule->command('inspire')->hourly();
        // });
    }

    /**
     * Register translations.
     */
    public function registerTranslations(): void
    {
        $langPath = resource_path('lang/modules/'.$this->nameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->nameLower);
            $this->loadJsonTranslationsFrom($langPath);
        } else {
            $this->loadTranslationsFrom(module_path($this->name, 'lang'), $this->nameLower);
            $this->loadJsonTranslationsFrom(module_path($this->name, 'lang'));
        }
    }

    /**
     * Register config.
     */
    protected function registerConfig(): void
    {
        $configPath = module_path($this->name, config('modules.paths.generator.config.path'));

        if (is_dir($configPath)) {
            $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($configPath));

            foreach ($iterator as $file) {
                if ($file->isFile() && $file->getExtension() === 'php') {
                    $config = str_replace($configPath.DIRECTORY_SEPARATOR, '', $file->getPathname());
                    $config_key = str_replace([DIRECTORY_SEPARATOR, '.php'], ['.', ''], $config);
                    $segments = explode('.', $this->nameLower.'.'.$config_key);

                    // Remove duplicated adjacent segments
                    $normalized = [];
                    foreach ($segments as $segment) {
                        if (end($normalized) !== $segment) {
                            $normalized[] = $segment;
                        }
                    }

                    $key = ($config === 'config.php') ? $this->nameLower : implode('.', $normalized);

                    $this->publishes([$file->getPathname() => config_path($config)], 'config');
                    $this->merge_config_from($file->getPathname(), $key);
                }
            }
        }
    }

    /**
     * Merge config from the given path recursively.
     */
    protected function merge_config_from(string $path, string $key): void
    {
        $existing = config($key, []);
        $module_config = require $path;

        config([$key => array_replace_recursive($existing, $module_config)]);
    }

    /**
     * Register views.
     */
    public function registerViews(): void
    {
        $viewPath = resource_path('views/modules/'.$this->nameLower);
        $sourcePath = module_path($this->name, 'resources/views');

        $this->publishes([$sourcePath => $viewPath], ['views', $this->nameLower.'-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->nameLower);

        Blade::componentNamespace(config('modules.namespace').'\\' . $this->name . '\\View\\Components', $this->nameLower);
    }

    /**
     * Get the services provided by the provider.
     */
    public function provides(): array
    {
        return [];
    }

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (config('view.paths') as $path) {
            if (is_dir($path.'/modules/'.$this->nameLower)) {
                $paths[] = $path.'/modules/'.$this->nameLower;
            }
        }

        return $paths;
    }
}

<?php

namespace Modules\Shared\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Nwidart\Modules\Traits\PathNamespace;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

use Modules\Shared\Services\LookupRegistry;

use Illuminate\Database\Eloquent\Relations\Relation;

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
		$this->loadPhpLookupsFromModules(); // Registers all lookup keys returning static values
		$this->loadDynamicLookupsFromProviders(); // Register all lookup keys wherein we fetch dynamic values
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

	        if (class_exists($providerClass)) {
     	       $provider = new $providerClass;

        	    if (method_exists($provider, 'getLookups')) {
            	    $lookups = $provider->getLookups();

	                foreach ($lookups as $key => $value) {
    	                LookupRegistry::register($key, $value);
        	        }
            	}
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
        // $this->commands([]);
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

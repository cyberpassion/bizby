<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API v1 Routes
|--------------------------------------------------------------------------
| This file defines all versioned API routes for the system.
| Routes are grouped by responsibility and architectural layer.
|--------------------------------------------------------------------------
*/

use Modules\Admin\Http\Controllers\Auth\AuthApiController;
use Modules\Admin\Http\Controllers\Auth\TfaApiController;

use Modules\Admin\Http\Controllers\Admins\AdminApiController;
use Modules\Admin\Http\Controllers\Tenants\TenantAccountApiController;
use Modules\Admin\Http\Controllers\Tenants\TenantUserApiController;
use Modules\Admin\Http\Controllers\Tenants\TenantModuleApiController;
use Modules\Admin\Http\Controllers\InstallationController;
use Modules\Admin\Http\Controllers\AuthTokenApiController;
use Modules\Admin\Http\Controllers\Auth\PasswordResetApiController;

use Modules\Admin\Http\Controllers\Modules\ModuleApiController;
use Modules\Admin\Http\Controllers\Addons\AddonApiController;

use Modules\Admin\Http\Controllers\Billings\BillingApiController;
use Modules\Admin\Http\Controllers\Billings\BillingModuleApiController;
use Modules\Admin\Http\Controllers\Billings\BillingAddonApiController;

/*
|--------------------------------------------------------------------------
| Public / Admin-Level APIs (Auth temporarily disabled)
|--------------------------------------------------------------------------
*/
Route::prefix('v1')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Admin Modules – Product Catalog Layer
    |--------------------------------------------------------------------------
    | Global definition of system modules.
    |
    | Responsibilities:
    | - Define available modules (name, description, base price)
    | - Control billing behavior (billable / core)
    | - Enable or disable modules globally
    |
    | Notes:
    | - Does NOT assign modules to tenants
    | - Does NOT process payments
    | - Tenant-specific activation happens via tenant_modules
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin/modules')->group(function () {

        Route::get('/', [ModuleApiController::class, 'index'])
            ->name('admin.modules.index');
        // List all modules in the global catalog.

        Route::post('/', [ModuleApiController::class, 'store'])
            ->name('admin.modules.store');
        // Create a new module (catalog entry).

        Route::put('/{id}', [ModuleApiController::class, 'update'])
            ->name('admin.modules.update');
        // Update module metadata or pricing.
        // Does NOT affect existing tenant price snapshots.

		Route::get('/{id}', [ModuleApiController::class, 'show'])
            ->name('admin.modules.show');
        // Get single module
	
        Route::patch('/{id}/toggle', [ModuleApiController::class, 'toggle'])
            ->name('admin.modules.toggle');
        // Enable or disable a module globally.
    });

	/*
    |--------------------------------------------------------------------------
    | Admin Addons – Product Catalog Layer
    |--------------------------------------------------------------------------
    | Global definition of system addons.
    |
    | Responsibilities:
    | - Define available addons (name, description, base price)
    | - Control billing behavior (billable / core)
    | - Enable or disable modules globally
    |
    | Notes:
    | - Does NOT assign modules to tenants
    | - Does NOT process payments
    | - Tenant-specific activation happens via tenant_modules
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin/addons')->group(function () {

        Route::get('/', [AddonApiController::class, 'index'])
            ->name('admin.addons.index');
        // List all addons in the global catalog.
        Route::post('/', [AddonApiController::class, 'store'])
            ->name('admin.addons.store');
        // Create a new addon (catalog entry).

        Route::put('/{id}', [AddonApiController::class, 'update'])
            ->name('admin.addons.update');
        // Update addon metadata or pricing.
        // Does NOT affect existing tenant price snapshots.

		Route::get('/{id}', [AddonApiController::class, 'show'])
            ->name('admin.addons.show');
        // Get single addon

        Route::patch('/{id}/toggle', [AddonApiController::class, 'toggle'])
            ->name('admin.addons.toggle');
        // Enable or disable a module globally.
    });

    /*
    |--------------------------------------------------------------------------
    | Tenant Management – Core Tenant Lifecycle
    |--------------------------------------------------------------------------
    | Handles creation and management of tenants.
    |--------------------------------------------------------------------------
    */
    Route::apiResource('tenants', TenantAccountApiController::class)
        ->except(['store'])
        ->names('tenants');

    Route::post('tenants', [TenantAccountApiController::class, 'storeWithTenancy'])
        ->name('tenants.store');
    // Create tenant and initialize tenancy context.

    /*
    |--------------------------------------------------------------------------
    | Tenant Modules – Feature & Access Management Layer
    |--------------------------------------------------------------------------
    | Controls which modules (features) are enabled for a tenant.
    |
    | Responsibilities:
    | - Enable / disable tenant features
    | - Prepare modules for billing (onboarding / add-ons)
    |
    | Notes:
    | - Does NOT process payments
    | - Billing handled via PaymentPayable + OnlinePayment
    |--------------------------------------------------------------------------
    */
    Route::prefix('tenants/{tenantId}/modules')->group(function () {

        Route::get('/', [TenantModuleApiController::class, 'index1'])
            ->name('tenantModule.index1');
        // List all modules assigned to a tenant.

        Route::post('/activate', [TenantModuleApiController::class, 'activateSingle'])
            ->name('tenantModule.activateSingle');
        // Activate a single module for a tenant.
        // May require payment if module is billable.

        Route::post('/activate-bulk', [TenantModuleApiController::class, 'activateMultiple'])
            ->name('tenantModule.activateMultiple');
        // Activate multiple modules at once.
        // Common during onboarding or upgrades.

        Route::post('/{moduleId}/deactivate', [TenantModuleApiController::class, 'deactivate'])
            ->name('tenantModule.deactivate');
        // Deactivate a tenant module.
        // Does NOT trigger refunds.
    });

	/*
    |--------------------------------------------------------------------------
    | Tenant Provisioning - FOR DEVELOPER ONLY
    |--------------------------------------------------------------------------
    | DEVELOPER / LOCAL
    |--------------------------------------------------------------------------
    */
	if (! app()->environment('production')) {
		Route::post('/tenants/{tenant}/provision-test', [
    		TenantAccountApiController::class,
    		'provisionForTesting'
		]);
	}

    /*
    |--------------------------------------------------------------------------
    | Tenant Installations
    |--------------------------------------------------------------------------
    | Tracks provisioning / setup logs for tenants.
    |--------------------------------------------------------------------------
    */
    Route::prefix('tenants/{tenantId}/installations')->group(function () {
        Route::get('/', [InstallationController::class, 'index'])
            ->name('installation.index');
    });

    Route::get('installations/{id}', [InstallationController::class, 'show'])
        ->name('installation.show');

    Route::post('installations', [InstallationController::class, 'store'])
        ->name('installation.store');

    /*
    |--------------------------------------------------------------------------
    | OTP Authentication
    |--------------------------------------------------------------------------
    */
    Route::post('/auth/send-otp', [AuthTokenApiController::class, 'sendLoginOtp'])
        ->middleware('throttle:3,10');

    /*
    |--------------------------------------------------------------------------
    | Admin Management
    |--------------------------------------------------------------------------
    */
    Route::apiResource('admins', AdminApiController::class)
        ->names('admins');
});

/*
|--------------------------------------------------------------------------
| Authentication APIs
|--------------------------------------------------------------------------
*/
Route::prefix('v1/auth')->group(function () {

    Route::post('login', [AuthApiController::class, 'login']);

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('tenants', [AuthApiController::class, 'tenants']);
        Route::get('me', [AuthApiController::class, 'me']);
        Route::post('logout', [AuthApiController::class, 'logout']);
    });

	Route::middleware(['auth:sanctum','identify.tenant'])->group(function () {
		Route::get('login/flow', [AuthApiController::class, 'loginFlow']);
		Route::post('tfa/send', [TfaApiController::class, 'sendTenantTfa']);
	    Route::post('tfa/verify', [TfaApiController::class, 'verifyTenantTfa']);
	});

});

/*
|--------------------------------------------------------------------------
| Tenant-Scoped User Provisioning
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:sanctum','identify.tenant'])
    ->prefix('v1/tenants/{tenantId}')
    ->group(function () {

        Route::post('/users', [TenantUserApiController::class, 'provisionUser']);
        Route::put('/users/{id}', [TenantUserApiController::class, 'updateUser']);
        Route::delete('/users/{id}', [TenantUserApiController::class, 'destroyUser']);

    });

/*
|--------------------------------------------------------------------------
| Password Reset APIs
|--------------------------------------------------------------------------
*/
Route::prefix('v1/auth/password')->group(function () {
    Route::post('forgot', [PasswordResetApiController::class, 'forgot']);
	Route::post('verify', [PasswordResetApiController::class, 'verify']);
    Route::post('reset', [PasswordResetApiController::class, 'reset']);
});

/*
|--------------------------------------------------------------------------
| Billing APIs
|--------------------------------------------------------------------------
*/
Route::prefix('v1/billing')
    ->middleware(['auth:sanctum', 'identify.tenant'])
    ->group(function () {

    // Subscription
    Route::get('/subscription', [BillingApiController::class, 'subscription']);
    Route::post('/subscription/renew', [BillingApiController::class, 'renew']);
    Route::post('/subscription/cancel', [BillingApiController::class, 'cancel']);

    // Plans
    Route::get('/plans', [BillingApiController::class, 'plans']);
    Route::post('/plan/change', [BillingApiController::class, 'changePlan']);

    // Modules
    Route::get('/modules', [BillingModuleApiController::class, 'index']);
    Route::post('/modules/add', [BillingModuleApiController::class, 'add']);
    Route::post('/modules/remove', [BillingModuleApiController::class, 'remove']);

    // Addons
    Route::get('/addons', [BillingAddonApiController::class, 'index']);
    Route::post('/addons/add', [BillingAddonApiController::class, 'add']);
    Route::post('/addons/remove', [BillingAddonApiController::class, 'remove']);

    // Invoices
    Route::get('/invoices', [BillingApiController::class, 'invoices']);
});

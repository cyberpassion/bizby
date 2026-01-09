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
use Modules\Admin\Http\Controllers\Admins\AdminApiController;
use Modules\Admin\Http\Controllers\Modules\ModuleApiController;
use Modules\Admin\Http\Controllers\Tenants\TenantAccountApiController;
use Modules\Admin\Http\Controllers\Tenants\TenantUserApiController;
use Modules\Admin\Http\Controllers\Tenants\TenantModuleApiController;
use Modules\Admin\Http\Controllers\InstallationController;
use Modules\Admin\Http\Controllers\AuthTokenApiController;

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
});

/*
|--------------------------------------------------------------------------
| User Management (Authenticated)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::post('users', [AuthApiController::class, 'createUser']);
});

/*
|--------------------------------------------------------------------------
| Tenant-Scoped User Provisioning
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:sanctum', 'tenant'])->prefix('v1/tenants')->group(function () {
    Route::post('users', [TenantUserApiController::class, 'provisionUser']);
});

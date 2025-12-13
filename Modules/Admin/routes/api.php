<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\AdminApiController;
use Modules\Admin\Http\Controllers\TenantController;
use Modules\Admin\Http\Controllers\TenantAuthController;
use Modules\Admin\Http\Controllers\TenantUserController;
use Modules\Admin\Http\Controllers\TenantModuleController;
use Modules\Admin\Http\Controllers\InstallationController;

/*Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('admins', AdminController::class)->names('admin');
});*/

// Temporarily disable auth middleware
Route::prefix('v1')->group(function () {
	// Tenant CRUD
    Route::apiResource('tenants', TenantController::class)->names('tenants');

    // Tenant Users
    Route::prefix('tenants/{tenantId}')->group(function () {
		Route::apiResource('users', TenantUserController::class)->names('tenant.users');
	});
	Route::post('/tenants/login', [TenantAuthController::class, 'login']);

    // Tenant Modules
    Route::prefix('tenants/{tenantId}/modules')->group(function () {
        Route::get('/', [TenantModuleController::class, 'index1'])->name('tenantModule.index1');
        Route::post('/activate', [TenantModuleController::class, 'activateSingle'])->name('tenantModule.activateSingle');
		Route::post('/activate-bulk', [TenantModuleController::class, 'activateMultiple'])->name('tenantModule.activateMultiple');
        Route::post('/{moduleId}/deactivate', [TenantModuleController::class, 'deactivate'])->name('tenantModule.deactivate');
    });

    // Installation Logs
    Route::prefix('tenants/{tenantId}/installations')->group(function () {
        Route::get('/', [InstallationController::class, 'index'])->name('installation.index');
    });
    Route::get('installations/{id}', [InstallationController::class, 'show'])->name('installation.show');
    Route::post('installations', [InstallationController::class, 'store'])->name('installation.store');

    Route::apiResource('admins', AdminApiController::class)->names('admins');
});
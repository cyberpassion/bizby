<?php

use Illuminate\Support\Facades\Route;

use Modules\Admin\Http\Controllers\Admins\AdminApiController;

use Modules\Admin\Http\Controllers\Tenants\TenantAccountApiController;
use Modules\Admin\Http\Controllers\Tenants\TenantAuthApiController;
use Modules\Admin\Http\Controllers\Tenants\TenantUserApiController;
use Modules\Admin\Http\Controllers\Tenants\TenantModuleApiController;

use Modules\Admin\Http\Controllers\InstallationController;
use Modules\Admin\Http\Controllers\AuthTokenApiController;

/*Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('admins', AdminController::class)->names('admin');
});*/

// Temporarily disable auth middleware
Route::prefix('v1')->group(function () {
	// Tenant CRUD
    //Route::apiResource('tenants', TenantAccountApiController::class)->names('tenants');
	Route::apiResource('tenants', TenantAccountApiController::class)->except(['store'])->names('tenants');
	Route::post('tenants', [TenantAccountApiController::class, 'storeWithTenancy'])->name('tenants.store');


    // Tenant Users
    Route::prefix('tenants/{tenantId}')->group(function () {
		Route::apiResource('users', TenantUserApiController::class)->names('tenant.users');
	});
	Route::post('/tenants/login', [TenantAuthApiController::class, 'login']);

    // Tenant Modules
    Route::prefix('tenants/{tenantId}/modules')->group(function () {
        Route::get('/', [TenantModuleApiController::class, 'index1'])->name('tenantModule.index1');
        Route::post('/activate', [TenantModuleApiController::class, 'activateSingle'])->name('tenantModule.activateSingle');
		Route::post('/activate-bulk', [TenantModuleApiController::class, 'activateMultiple'])->name('tenantModule.activateMultiple');
        Route::post('/{moduleId}/deactivate', [TenantModuleApiController::class, 'deactivate'])->name('tenantModule.deactivate');
    });

    // Installation Logs
    Route::prefix('tenants/{tenantId}/installations')->group(function () {
        Route::get('/', [InstallationController::class, 'index'])->name('installation.index');
    });
    Route::get('installations/{id}', [InstallationController::class, 'show'])->name('installation.show');
    Route::post('installations', [InstallationController::class, 'store'])->name('installation.store');

	Route::post('/auth/send-otp',[AuthTokenApiController::class, 'sendLoginOtp'])->middleware('throttle:3,10');

    Route::apiResource('admins', AdminApiController::class)->names('admins');
});
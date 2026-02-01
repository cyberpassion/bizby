<?php

use Illuminate\Support\Facades\Route;
use Modules\Shared\Http\Controllers\SharedApiController;
use Modules\Shared\Http\Controllers\LookupsApiController; // Options Controller
use Modules\Shared\Http\Controllers\UploadApiController; // Upload Controller
use Modules\Shared\Http\Controllers\TermApiController;

use Modules\Shared\Http\Controllers\OnlinePayments\OnlinePaymentApiController;
use Modules\Shared\Http\Controllers\OnlinePayments\PaymentPayableApiController;

use Modules\Shared\Http\Controllers\OptionApiController;
use Modules\Shared\Http\Controllers\ActivityLogApiController;
use Modules\Shared\Http\Controllers\FormApiController;
use Modules\Shared\Http\Controllers\BarricadeApiController;
use Modules\Shared\Http\Controllers\SearchApiController;

use Modules\Shared\Http\Controllers\RazorpayWebhookController;

use Modules\Shared\Http\Controllers\DatabaseManagementApiController;

// Schedules
use Modules\Shared\Http\Controllers\Schedules\ScheduleJobRegistryApiController;
use Modules\Shared\Http\Controllers\Schedules\ScheduleApiController;
use Modules\Shared\Http\Controllers\Schedules\ScheduleRunApiController;

// Permissions
use Modules\Shared\Http\Controllers\Permissions\PermissionApiController;
use Modules\Shared\Http\Controllers\Permissions\RoleApiController;
use Modules\Shared\Http\Controllers\Permissions\RolePermissionApiController;
use Modules\Shared\Http\Controllers\Permissions\UserRoleApiController;
use Modules\Shared\Http\Controllers\Permissions\UserPermissionApiController;
use Modules\Shared\Http\Controllers\Permissions\PermissionTreeApiController;

// Navigation
use Modules\Shared\Http\Controllers\Navigations\NavigationApiController;

/*Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('shareds', SharedController::class)->names('shared');
});*/

// Temporarily disable auth middleware
Route::prefix('v1')->group(function () {
    Route::apiResource('shared', SharedApiController::class)->names('shared');

	// Lookups for common static values like gender, list of countries
	Route::get('/lookups/{key}', [LookupsApiController::class, 'get']);

	Route::get('/form/{module}/{name}', [FormApiController::class, 'show']);

	// Terms for dynamic values like student classes etc
	Route::apiResource('terms', TermApiController::class)->names('term');

	// Uploads
	Route::apiResource('uploads', UploadApiController::class)->names('upload');
	Route::post('uploads/bulk-data', [UploadApiController::class, 'bulkData'])->name('uploads.bulkData');
	Route::post('uploads/bulk-documents', [UploadApiController::class, 'bulkDocuments'])->name('uploads.bulkDocuments');

	// Options
	Route::apiResource('options', OptionApiController::class)->names('option');
	Route::get('/options/group/{key}', [OptionApiController::class, 'group']);

	// Activity Logs
	Route::apiResource('activity-logs', ActivityLogApiController::class)->names('activityLog');

	// ------------------------------------------------------------------
	// Payables (Business Intent Layer)
	// ------------------------------------------------------------------
	// Handles creation, preview, and lifecycle of PaymentPayable records.
	// A PaymentPayable represents a *frozen billing intent* BEFORE payment.
	// Examples: tenant onboarding, renewal, add-on modules, penalties.
	//
	// Notes:
	// - Does NOT process money
	// - Does NOT talk to payment gateways
	// - Driven by domain models implementing the Payable contract
	// ------------------------------------------------------------------

	Route::post(
    	'/payment-payables/resolve',
    	[PaymentPayableApiController::class, 'resolve']
	);
	// Resolve a payable entity (tenant, registration, etc.) and return
	// a lightweight summary (amount, purpose, snapshot).
	// Used by UI to quickly understand "what is being paid".
	// Does NOT create any database record.

	Route::post(
	    '/payment-payables/preview',
    	[PaymentPayableApiController::class, 'preview']
	);
	// Preview a payable BEFORE checkout.
	// Returns computed billing details such as:
	// - payable amount
	// - validity / renewal dates
	// - module breakdown
	// - charge type (onboarding, renewal, addon)
	// Does NOT create any database record.

	Route::post(
    	'/payment-payables/checkout',
    	[PaymentPayableApiController::class, 'checkout']
	);
	// Create a PaymentPayable record (frozen billing intent).
	// This locks the amount, purpose, and snapshot so that:
	// - frontend cannot tamper values
	// - pricing remains consistent during payment
	// Called AFTER preview and BEFORE initiating payment gateway flow.
	Route::post(
    	'/payment-payables/{id}/cancel',
    	[PaymentPayableApiController::class, 'cancel']
	);
	// Cancel a pending PaymentPayable intent.
	// Used when user abandons checkout or wants to restart payment.
	// Only affects unpaid, pending payables.
	// Does NOT refund money (refunds are handled at payment level).


	// ------------------------------------------------------------------
	// Online Payments (Money & Gateway Layer)
	// ------------------------------------------------------------------
	// Handles actual payment transactions with external gateways
	// (Razorpay, Stripe, etc.).
	//
	// Responsibilities:
	// - Create gateway payment/order
	// - Record gateway references
	// - Track payment status lifecycle
	// - Trigger post-payment business finalization
	//
	// Notes:
	// - NEVER calculates amounts
	// - NEVER decides business logic (renewal, activation, etc.)
	// - Operates strictly on PaymentPayable records
	// ------------------------------------------------------------------

	Route::post(
    	'/online-payments/initiate',
    	[OnlinePaymentApiController::class, 'initiate']
	);
	// Initiate payment for an existing PaymentPayable.
	// Creates a payment transaction and gateway order.
	// Called AFTER checkout and BEFORE user completes payment.

	Route::put(
    	'/online-payments/{id}/complete',
    	[OnlinePaymentApiController::class, 'complete']
	);
	// Receive gateway payment reference after user completes payment.
	// Saves gateway payment ID and marks transaction as "processing".
	// Does NOT execute any business logic.

	Route::put(
    	'/online-payments/{id}/finalize',
    	[OnlinePaymentApiController::class, 'finalize']
	);
	// Finalize payment AFTER successful gateway confirmation.
	// Executes post-payment business logic such as:
	// - Activating tenant
	// - Renewing subscription
	// - Enabling modules
	// This operation is idempotent and safe to retry.

	Route::get(
	    '/online-payments/{payment}/payable',
    	[PaymentPayableApiController::class, 'showByPayment']
	);
	// Fetch frozen PaymentPayable snapshot by online_payment_id.
	// Used AFTER payment for:
	// - receipt page
	// - invoice download
	// - email receipt
	// - audit logs
	//
	// IMPORTANT:
	// - Returns immutable snapshot (what user actually paid)
	// - Does NOT recalculate amounts
	// - Safe to refresh (idempotent)
	// - Works even if pricing rules change later

	Route::put(
    	'/online-payments/{id}/status',
    	[OnlinePaymentApiController::class, 'status']
	);
	// Fetch current payment status for frontend polling.
	// Used to check whether payment is pending, processing, or finalized.
	// Does NOT mutate any data.

	Route::apiResource(
    	'online-payments',
    	OnlinePaymentApiController::class
	)->names('onlinePayment');
	// Standard RESTful endpoints for listing and viewing payments.
	// Used for dashboards, audit logs, and admin tooling.
	// Should NOT be used to mutate payment lifecycle directly.

	// Payment Webhooks
	Route::post('webhooks/razorpay', [RazorpayWebhookController::class, 'handle']);

	Route::get('/barricade/{key}', [BarricadeApiController::class, 'get']);

	Route::get('/search/{module}', [SearchApiController::class, 'search']);

	// History
	Route::get('/schedules/{schedule}/runs', [ScheduleApiController::class, 'runs']);

	// Temporary
	Route::post('/infra/databases', [DatabaseManagementApiController::class, 'store']);
    Route::delete('/infra/databases/{name}', [DatabaseManagementApiController::class, 'destroy']);

});

// Schedules
// ->middleware(['auth:sanctum'])
Route::prefix('v1')->group(function () {

    /* ---------------- Job registry ---------------- */
    Route::get('/scheduler/jobs', [ScheduleJobRegistryApiController::class, 'index']);
    Route::get('/scheduler/jobs/{key}', [ScheduleJobRegistryApiController::class, 'show']);

    /* ---------------- Schedules CRUD ---------------- */
    Route::get('/schedules', [ScheduleApiController::class, 'index']);
    Route::post('/schedules', [ScheduleApiController::class, 'store']);
    Route::get('/schedules/{schedule}', [ScheduleApiController::class, 'show']);
    Route::put('/schedules/{schedule}', [ScheduleApiController::class, 'update']);
    Route::delete('/schedules/{schedule}', [ScheduleApiController::class, 'destroy']);

    /* ---------------- Schedule actions ---------------- */
    Route::post('/schedules/{schedule}/toggle', [ScheduleApiController::class, 'toggle']);
    Route::post('/schedules/{schedule}/run', [ScheduleApiController::class, 'runNow']);
    Route::post('/schedules/{schedule}/pause', [ScheduleApiController::class, 'pause']);
    Route::post('/schedules/{schedule}/resume', [ScheduleApiController::class, 'resume']);

    /* ---------------- Schedule runs (logs) ---------------- */
    Route::get('/schedules/{schedule}/runs', [ScheduleRunApiController::class, 'index']);
    Route::get('/schedules/{schedule}/runs/{run}', [ScheduleRunApiController::class, 'show']);
});

// Permissions
// protect these by ->middleware('permission:permissions.manage')
Route::prefix('v1')
    /*->middleware(['auth:sanctum', 'tenant', 'permission:permissions.manage'])*/
	->middleware(['auth:sanctum', 'identify.tenant'])
    ->group(function () {

    // permissions master
    Route::apiResource('permissions', PermissionApiController::class)
        ->only(['index', 'store', 'destroy']);

    // roles
    Route::apiResource('roles', RoleApiController::class)
        ->only(['index', 'store', 'destroy']);

    // role permissions
    Route::get('/roles/{role}/permissions', [RolePermissionApiController::class, 'index']);
    Route::put('/roles/{role}/permissions', [RolePermissionApiController::class, 'sync']);

    // user roles
    Route::get('/users/{user}/roles', [UserRoleApiController::class, 'index']);
    Route::post('/users/{user}/roles', [UserRoleApiController::class, 'assign']);
    Route::delete('/users/{user}/roles/{role}', [UserRoleApiController::class, 'revoke']);

    // user permission overrides
    Route::get('/users/{user}/permissions', [UserPermissionApiController::class, 'index']);
    Route::put('/users/{user}/permissions', [UserPermissionApiController::class, 'sync']);
    Route::delete('/users/{user}/permissions/{permission}', [UserPermissionApiController::class, 'revoke']);
});

Route::prefix('v1')
    ->middleware(['auth:sanctum', 'identify.tenant'])
    ->group(function () {

        /* ============================
         | Navigation (READ ONLY)
         |============================ */
        Route::get('/navigation/sidebar', [NavigationApiController::class, 'sidebar']);
        Route::get('/navigation/header',  [NavigationApiController::class, 'header']);
        Route::get('/navigation/module/{module}', [NavigationApiController::class, 'module']);
        Route::get('/navigation/item/{module}/{id}', [NavigationApiController::class, 'item']);

});
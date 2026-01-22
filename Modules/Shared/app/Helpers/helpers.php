<?php

use Modules\Shared\Helpers\Permissions;

/**
 * Global permission helper
 *
 * Usage:
 *  can('orders.export');
 *  can('users.update', 'own');
 *  can('invoices.approve');
 *
 * This is a wrapper around Permissions::can()
 * so we can call permissions anywhere without
 * importing the Permissions class.
 *
 * Why this exists:
 * - Cleaner syntax
 * - Laravel-like helper style (auth(), route(), config())
 * - Central place for permission checks
 * - Works in controllers, services, middleware, policies, routes
 *
 * IMPORTANT:
 * - Always uses authenticated user
 * - Always uses current tenant
 * - Returns true/false only (no exceptions)
 */
if (!function_exists('can')) {

    /**
     * Check if the authenticated user has a permission
     *
     * @param string $slug  Permission slug (e.g. users.update, orders.export)
     * @param string|null $scope Optional scope (own, team, tenant, global)
     *
     * @return bool
     */
    function can(string $slug, ?string $scope = null): bool
    {
        // Get currently authenticated user
        $user = auth()->user();

        // If user is not logged in, deny access
        if (!$user) {
            return false;
        }

        // Delegate actual permission logic to Permissions class
        // This keeps helper thin and logic centralized
        return Permissions::can(
            $user->id,        // authenticated user id
            tenant()->id,     // current tenant id (SaaS context)
            $slug,            // permission slug
            $scope            // optional scope
        );
    }
}

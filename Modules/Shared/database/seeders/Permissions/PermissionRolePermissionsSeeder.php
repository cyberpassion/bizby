<?php

namespace Modules\Shared\Database\Seeders\Permissions;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionRolePermissionsSeeder extends Seeder
{
    public function run(): void
    {
        $roles = DB::table('permission_roles')
            ->get()
            ->keyBy('slug');

        $permissions = DB::table('permission_permissions')
            ->get();

        foreach ($permissions as $permission) {

            $pid = $permission->id;

            $slug = $permission->slug;

            $resourceName = $permission->resource;

            $permissionType = $permission->surface; // e.g. admin, portal, api

            /**
             * -------------------------------------------------
             * OWNER → EVERYTHING
             * -------------------------------------------------
             */
            if (
                isset($roles['owner']) &&
                $roles['owner']->surface === $permissionType
            ) {

                DB::table('permission_role_permissions')
                    ->updateOrInsert(
                        [
                            'role_id' => $roles['owner']->id,
                            'permission_id' => $pid,
                        ],
                        [
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]
                    );
            }

            /**
             * -------------------------------------------------
             * ADMIN → EVERYTHING EXCEPT BILLING
             * -------------------------------------------------
             */
            if (
                isset($roles['admin']) &&
                $roles['admin']->surface === $permissionType &&
                ! str_contains($slug, 'plans') &&
                ! str_contains($slug, 'subscriptions')
            ) {

                DB::table('permission_role_permissions')
                    ->updateOrInsert(
                        [
                            'role_id' => $roles['admin']->id,
                            'permission_id' => $pid,
                        ],
                        [
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]
                    );
            }

            /**
             * -------------------------------------------------
             * MANAGER → VIEW + CREATE + UPDATE
             * -------------------------------------------------
             */
            if (
                isset($roles['manager']) &&
                $roles['manager']->surface === $permissionType &&
                preg_match(
                    '/\.(view|create|update)$/',
                    $slug
                )
            ) {

                DB::table('permission_role_permissions')
                    ->updateOrInsert(
                        [
                            'role_id' => $roles['manager']->id,
                            'permission_id' => $pid,
                        ],
                        [
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]
                    );
            }

            /**
             * -------------------------------------------------
             * STAFF → VIEW + CREATE
             * -------------------------------------------------
             */
            if (
                isset($roles['staff']) &&
                $roles['staff']->surface === $permissionType &&
                preg_match(
                    '/\.(view|create)$/',
                    $slug
                )
            ) {

                DB::table('permission_role_permissions')
                    ->updateOrInsert(
                        [
                            'role_id' => $roles['staff']->id,
                            'permission_id' => $pid,
                        ],
                        [
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]
                    );
            }

            /**
             * -------------------------------------------------
             * VIEWER → VIEW ONLY
             * -------------------------------------------------
             */
            if (
                isset($roles['viewer']) &&
                $roles['viewer']->surface === $permissionType &&
                str_ends_with($slug, '.view')
            ) {

                DB::table('permission_role_permissions')
                    ->updateOrInsert(
                        [
                            'role_id' => $roles['viewer']->id,
                            'permission_id' => $pid,
                        ],
                        [
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]
                    );
            }

            /**
             * -------------------------------------------------
             * META-DRIVEN ROLES
             * -------------------------------------------------
             */
            foreach ($roles as $role) {

                /**
                 * -------------------------------------------------
                 * PREVENT CROSS-TYPE PERMISSIONS
                 * -------------------------------------------------
                 */
                if ($role->surface !== $permissionType) {
                    continue;
                }

                /**
                 * -------------------------------------------------
                 * PORTAL USERS ALWAYS GET access.portal
                 * -------------------------------------------------
                 */
                if (
                    $role->surface === 'portal' &&
                    $slug === 'access.portal'
                ) {

                    DB::table('permission_role_permissions')
                        ->updateOrInsert(
                            [
                                'role_id' => $role->id,
                                'permission_id' => $pid,
                            ],
                            [
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]
                        );

                    continue;
                }

                /**
                 * -------------------------------------------------
                 * SKIP ROLES WITHOUT META
                 * -------------------------------------------------
                 */
                if (! $role->meta) {
                    continue;
                }

                $meta = json_decode(
                    $role->meta,
                    true
                );

                if (! $meta) {
                    continue;
                }

                /**
                 * -------------------------------------------------
                 * RESOURCES
                 * -------------------------------------------------
                 */
                $resources = $meta['resources'] ?? [];

                $extraResources = $meta['extra_resources'] ?? [];

                $allowedResources = array_merge(
                    $resources,
                    $extraResources
                );

                if (empty($allowedResources)) {
                    continue;
                }

                foreach ($allowedResources as $allowed) {

                    /**
                     * -------------------------------------------------
                     * MATCH RESOURCE
                     * -------------------------------------------------
                     *
                     * vendor
                     * vendor.documents
                     * vendor.settings
                     */
                    if (
                        $resourceName === $allowed ||
                        str_starts_with(
                            $resourceName,
                            $allowed.'.'
                        )
                    ) {

                        /**
                         * -------------------------------------------------
                         * RESTRICT PORTAL USERS
                         * -------------------------------------------------
                         */
                        if ($role->surface === 'portal') {

                            if (
                                ! str_ends_with($slug, '.view') &&
                                $slug !== 'access.portal'
                            ) {
                                continue 2;
                            }
                        }

                        DB::table('permission_role_permissions')
                            ->updateOrInsert(
                                [
                                    'role_id' => $role->id,
                                    'permission_id' => $pid,
                                ],
                                [
                                    'created_at' => now(),
                                    'updated_at' => now(),
                                ]
                            );

                        break;
                    }
                }
            }

            /**
             * -------------------------------------------------
             * CUSTOM ROLES
             * NO AUTO PERMISSIONS
             * -------------------------------------------------
             */
        }
    }
}

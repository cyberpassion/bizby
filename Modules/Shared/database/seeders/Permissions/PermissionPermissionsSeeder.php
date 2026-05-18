<?php

namespace Modules\Shared\Database\Seeders\Permissions;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Modules\Shared\Models\Permissions\PermissionPermission;

class PermissionPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        /**
         * -------------------------------------------------
         * MODULES
         * -------------------------------------------------
         */
        $this->seedModulePermissions();

        /**
         * -------------------------------------------------
         * ADDONS
         * -------------------------------------------------
         */
        $this->seedAddonPermissions();

        /**
         * -------------------------------------------------
         * FEATURES
         * -------------------------------------------------
         */
        $this->seedFeaturePermissions();

        /**
         * -------------------------------------------------
         * ACCESS
         * -------------------------------------------------
         */
        $this->seedAccessPermissions();
    }

    /**
     * =================================================
     * MODULES
     * =================================================
     */
    protected function seedModulePermissions(): void
    {
        $modulesPath = base_path('Modules');

        $permissions = [];

        foreach (File::directories($modulesPath) as $modulePath) {

            $moduleName = basename($modulePath);

            $currentlyAllowed = [
                'Asset',
                'Incident',
                'Center',
                'Maintenance',
                'Product',
                'Inventory',
                'Vendor',
                'Employee',
                'Note',
                'Consultation',
                'Registration',
                'Listing',
                'Attendance',
                'Lead',
                'Student',
            ];

            if (! in_array($moduleName, $currentlyAllowed)) {
                continue;
            }

            $configPath = $modulePath
                .'/config/ui/'
                .$moduleName
                .'.php';

            if (! file_exists($configPath)) {
                continue;
            }

            $config = require $configPath;

            $this->extractPermissions(
                $config,
                $permissions
            );
        }

        $permissions = array_unique(
            array_filter($permissions)
        );

        foreach ($permissions as $slug) {

            $parts = explode('.', $slug);

            $this->savePermission([
                'surface' => 'admin',

                'category' => 'module',

                'resource' => strtolower(
                    $parts[0] ?? 'general'
                ),

                'subresource' => null,

                'operation' => end($parts) ?: 'view',

                'slug' => $slug,

                'scope' => 'global',

                'guard' => 'api',
            ]);
        }
    }

    /**
     * =================================================
     * ADDONS
     * =================================================
     */
    protected function seedAddonPermissions(): void
    {
        foreach ($this->getAddons() as $addon) {

            foreach ($addon['operations'] as $operation) {

                $slug = 'addon.'
                    .$addon['name']
                    .'.'
                    .$operation;

                $this->savePermission([
                    'surface' => 'admin',

                    'category' => 'addon',

                    'resource' => $addon['name'],

                    'subresource' => null,

                    'operation' => $operation,

                    'slug' => $slug,

                    'scope' => 'global',

                    'guard' => 'api',
                ]);
            }
        }
    }

    /**
     * =================================================
     * FEATURES
     * =================================================
     */
    protected function seedFeaturePermissions(): void
    {
        foreach ($this->getFeatures() as $resource => $features) {

            foreach ($features as $feature) {

                $slug = $resource
                    .'.'
                    .$feature
                    .'.manage';

                $this->savePermission([
                    'surface' => 'admin',

                    'category' => 'feature',

                    'resource' => $resource,

                    'subresource' => $feature,

                    'operation' => 'manage',

                    'slug' => $slug,

                    'scope' => 'global',

                    'guard' => 'api',
                ]);
            }
        }
    }

    /**
     * =================================================
     * ACCESS
     * =================================================
     */
    protected function seedAccessPermissions(): void
    {
        /**
         * admin | access | admin
         */
        $this->savePermission([
            'surface' => 'admin',

            'category' => 'access',

            'resource' => 'admin',

            'subresource' => null,

            'operation' => 'access',

            'slug' => 'access.admin',

            'scope' => 'global',

            'guard' => 'api',

            'is_system' => true,
        ]);

        /**
         * portal | access | portal
         */
        $this->savePermission([
            'surface' => 'portal',

            'category' => 'access',

            'resource' => 'portal',

            'subresource' => null,

            'operation' => 'access',

            'slug' => 'access.portal',

            'scope' => 'global',

            'guard' => 'api',

            'is_system' => true,
        ]);
    }

    /**
     * =================================================
     * SAVE
     * =================================================
     */
    protected function savePermission(array $data): void
    {
        PermissionPermission::updateOrCreate(
            [
                'slug' => $data['slug'],
            ],
            [
                'surface' => $data['surface'],

                'category' => $data['category'],

                'resource' => $data['resource'],

                'subresource' => $data['subresource'] ?? null,

                'operation' => $data['operation'],

                'description' => $data['description'] ?? null,

                'scope' => $data['scope'] ?? 'global',

                'guard' => $data['guard'] ?? 'api',

                'parent_id' => $data['parent_id'] ?? null,

                'is_assignable' => $data['is_assignable'] ?? true,

                'is_system' => $data['is_system'] ?? false,
            ]
        );
    }

    /**
     * =================================================
     * EXTRACT MODULE PERMISSIONS
     * =================================================
     */
    protected function extractPermissions(
        array $data,
        array &$permissions
    ): void {

        foreach ($data as $item) {

            if (is_array($item)) {

                if (isset($item['permission'])) {
                    $permissions[] = $item['permission'];
                }

                $this->extractPermissions(
                    $item,
                    $permissions
                );
            }
        }
    }

    /**
     * =================================================
     * MOCK ADDONS
     * =================================================
     */
    protected function getAddons(): array
    {
        return [

            [
                'name' => 'whatsapp',

                'operations' => [
                    'access',
                    'send',
                    'manage',
                ],
            ],

            [
                'name' => 'zoom',

                'operations' => [
                    'access',
                    'create',
                ],
            ],

        ];
    }

    /**
     * =================================================
     * MOCK FEATURES
     * =================================================
     */
    protected function getFeatures(): array
    {
        return [

            'student' => [
                'attendance',
                'transport',
                'hostel',
            ],

            'vendor' => [
                'documents',
                'payments',
            ],

            'whatsapp' => [
                'campaigns',
                'automation',
            ],

        ];
    }
}

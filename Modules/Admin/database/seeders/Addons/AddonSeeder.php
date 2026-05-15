<?php

namespace Modules\Admin\Database\Seeders\Addons;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AddonSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $addons = [

            /*
            |--------------------------------------------------------------------------
            | Productivity Addons
            |--------------------------------------------------------------------------
            */

            [
                'key' => 'calendar',
                'name' => 'Calendar',
                'category' => 'Productivity',
                'icon' => 'calendar-days',
                'short_description' => 'Calendar and scheduling addon.',
                'description' => 'Provides calendars, event scheduling, reminders, meeting planning, and activity tracking across modules.',
                'features' => [
                    'Event calendar',
                    'Reminders',
                    'Meeting schedules',
                    'Activity planning',
                ],
                'version' => '1.0.0',
                'price' => null,
                'billing_cycle' => 'yearly',
                'is_billable' => false,
                'is_active' => true,
            ],

            [
                'key' => 'upload',
                'name' => 'Uploads',
                'category' => 'Storage',
                'icon' => 'upload-cloud',
                'short_description' => 'File upload and storage addon.',
                'description' => 'Handles file uploads, media storage, document management, and attachment support across modules.',
                'features' => [
                    'File uploads',
                    'Document storage',
                    'Media management',
                    'Attachment support',
                ],
                'version' => '1.0.0',
                'price' => null,
                'billing_cycle' => 'yearly',
                'is_billable' => false,
                'is_active' => true,
            ],

            [
                'key' => 'automation',
                'name' => 'Automation',
                'category' => 'Automation',
                'icon' => 'bot',
                'short_description' => 'Workflow automation addon.',
                'description' => 'Automates repetitive workflows, scheduled actions, notifications, and background processes.',
                'features' => [
                    'Workflow automation',
                    'Scheduled jobs',
                    'Auto notifications',
                    'Background tasks',
                ],
                'version' => '1.0.0',
                'price' => 500,
                'billing_cycle' => 'monthly',
                'is_billable' => true,
                'is_active' => true,
            ],

            [
                'key' => 'backup',
                'name' => 'Backup',
                'category' => 'Security',
                'icon' => 'database-backup',
                'short_description' => 'Automated backup management.',
                'description' => 'Provides automated database backups, restore management, recovery tools, and backup scheduling.',
                'features' => [
                    'Auto backups',
                    'Restore support',
                    'Backup scheduling',
                    'Recovery management',
                ],
                'version' => '1.0.0',
                'price' => 300,
                'billing_cycle' => 'monthly',
                'is_billable' => true,
                'is_active' => true,
            ],

            [
                'key' => 'sms',
                'name' => 'SMS Gateway',
                'category' => 'Communication',
                'icon' => 'message-square',
                'short_description' => 'SMS communication integration.',
                'description' => 'Enables SMS sending, OTP verification, notifications, alerts, and communication workflows.',
                'features' => [
                    'SMS sending',
                    'OTP verification',
                    'Bulk messaging',
                    'Alert notifications',
                ],
                'version' => '1.0.0',
                'price' => 700,
                'billing_cycle' => 'monthly',
                'is_billable' => true,
                'is_active' => true,
            ],

            [
                'key' => 'email',
                'name' => 'Email Service',
                'category' => 'Communication',
                'icon' => 'mail',
                'short_description' => 'Email integration addon.',
                'description' => 'Provides email sending, templates, campaigns, notifications, and email communication services.',
                'features' => [
                    'Email sending',
                    'Templates',
                    'Campaigns',
                    'Notifications',
                ],
                'version' => '1.0.0',
                'price' => 400,
                'billing_cycle' => 'monthly',
                'is_billable' => true,
                'is_active' => true,
            ],

            [
                'key' => 'whatsapp',
                'name' => 'WhatsApp Integration',
                'category' => 'Communication',
                'icon' => 'message-circle',
                'short_description' => 'WhatsApp messaging integration.',
                'description' => 'Enables WhatsApp messaging, notifications, customer communication, and automated WhatsApp workflows.',
                'features' => [
                    'WhatsApp messaging',
                    'Notifications',
                    'Automation',
                    'Customer communication',
                ],
                'version' => '1.0.0',
                'price' => 900,
                'billing_cycle' => 'monthly',
                'is_billable' => true,
                'is_active' => true,
            ],

            [
                'key' => 'analytics',
                'name' => 'Analytics',
                'category' => 'Reporting',
                'icon' => 'bar-chart-3',
                'short_description' => 'Advanced analytics and reporting.',
                'description' => 'Provides dashboards, business analytics, KPIs, charts, insights, and advanced reporting tools.',
                'features' => [
                    'Dashboards',
                    'Analytics',
                    'Charts',
                    'Reports',
                ],
                'version' => '1.0.0',
                'price' => 1200,
                'billing_cycle' => 'yearly',
                'is_billable' => true,
                'is_active' => true,
            ],

        ];

        DB::table('addons')->upsert(

            collect($addons)->map(fn ($addon) => [

                'key' => $addon['key'],

                'name' => $addon['name'],

                'description' => $addon['description'],

                'price' => $addon['price'],

                'billing_cycle' => $addon['billing_cycle'],

                'is_active' => $addon['is_active'],

                'created_at' => $now,

                'updated_at' => $now,

            ])->toArray(),

            ['key'],

            [
                'name',
                'description',
                'price',
                'billing_cycle',
                'is_active',
                'updated_at',
            ]
        );
    }
}
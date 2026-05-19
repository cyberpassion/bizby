<?php

namespace Modules\Admin\Database\Seeders\Modules;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ModuleSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $modules = [
            [
                'key' => 'admin',
                'name' => 'Admin',
                'category' => 'System',
                'icon' => 'shield-check',
                'short_description' => 'Platform administration and control center.',
                'description' => 'Provides complete administrative control including tenant management, system configuration, permissions, and platform monitoring.',
                'features' => ['Tenant management', 'Permissions', 'System settings', 'Monitoring'],
                'dependencies' => [],
                'permissions' => ['admin.view', 'admin.manage'],
                'version' => '1.0.0',
                'price' => null,
                'is_billable' => false,
                'is_core' => true,
            ],

            [
                'key' => 'shared',
                'name' => 'Shared',
                'category' => 'System',
                'icon' => 'layers',
                'short_description' => 'Shared infrastructure and utilities.',
                'description' => 'Provides reusable helpers, utilities, services, and infrastructure used across all modules.',
                'features' => ['Shared services', 'Reusable helpers', 'Utilities', 'Infrastructure'],
                'dependencies' => [],
                'permissions' => [],
                'version' => '1.0.0',
                'price' => null,
                'is_billable' => false,
                'is_core' => true,
            ],

            [
                'key' => 'subscription',
                'name' => 'Subscription',
                'category' => 'System',
                'icon' => 'credit-card',
                'short_description' => 'Subscription and billing management.',
                'description' => 'Handles plans, invoices, renewals, subscriptions, and billing workflows.',
                'features' => ['Plans', 'Invoices', 'Payments', 'Renewals'],
                'dependencies' => [],
                'permissions' => ['subscription.view', 'subscription.manage'],
                'version' => '1.0.0',
                'price' => null,
                'is_billable' => false,
                'is_core' => true,
            ],

            [
                'key' => 'student',
                'name' => 'Student Management',
                'category' => 'Education',
                'icon' => 'graduation-cap',
                'short_description' => 'Complete student management system.',
                'description' => 'Handles admissions, profiles, guardians, academics, and student lifecycle management.',
                'features' => ['Admissions', 'Profiles', 'Guardians', 'Academic records'],
                'dependencies' => [],
                'permissions' => ['student.view', 'student.create', 'student.edit'],
                'version' => '1.0.0',
                'price' => 1500,
            ],

            [
                'key' => 'attendance',
                'name' => 'Attendance',
                'category' => 'Education',
                'icon' => 'calendar-check',
                'short_description' => 'Attendance tracking system.',
                'description' => 'Tracks student and staff attendance with reports and analytics.',
                'features' => ['Attendance', 'Reports', 'Analytics', 'Notifications'],
                'dependencies' => ['student'],
                'permissions' => ['attendance.view', 'attendance.mark'],
                'version' => '1.0.0',
                'price' => 700,
            ],

            [
                'key' => 'timetable',
                'name' => 'Timetable',
                'category' => 'Education',
                'icon' => 'calendar-days',
                'short_description' => 'Timetable scheduling system.',
                'description' => 'Manages classes, schedules, teacher assignments, and lecture timings.',
                'features' => ['Schedules', 'Teacher assignment', 'Class planning', 'Conflict management'],
                'dependencies' => ['student'],
                'permissions' => ['timetable.view', 'timetable.manage'],
                'version' => '1.0.0',
                'price' => 600,
            ],

            [
                'key' => 'exammanager',
                'name' => 'Exam Manager',
                'category' => 'Education',
                'icon' => 'clipboard-check',
                'short_description' => 'Exam management system.',
                'description' => 'Handles exam planning, schedules, grading systems, and exam workflows.',
                'features' => ['Exam schedules', 'Grading', 'Planning', 'Exam workflows'],
                'dependencies' => ['student'],
                'permissions' => ['exam.view', 'exam.manage'],
                'version' => '1.0.0',
                'price' => 900,
            ],

            [
                'key' => 'examresult',
                'name' => 'Exam Result',
                'category' => 'Education',
                'icon' => 'file-bar-chart',
                'short_description' => 'Exam results and marksheets.',
                'description' => 'Generates report cards, marksheets, grades, and performance analytics.',
                'features' => ['Marksheets', 'Report cards', 'Grades', 'Analytics'],
                'dependencies' => ['exammanager'],
                'permissions' => ['result.view', 'result.publish'],
                'version' => '1.0.0',
                'price' => 700,
            ],

            [
                'key' => 'library',
                'name' => 'Library',
                'category' => 'Education',
                'icon' => 'book-open',
                'short_description' => 'Library management system.',
                'description' => 'Handles books, inventory, issue-return workflows, and fines.',
                'features' => ['Books', 'Issue-return', 'Inventory', 'Fine management'],
                'dependencies' => ['student'],
                'permissions' => ['library.view', 'library.issue'],
                'version' => '1.0.0',
                'price' => 800,
            ],

            [
                'key' => 'transport',
                'name' => 'Transport',
                'category' => 'Education',
                'icon' => 'bus',
                'short_description' => 'Transport and route management.',
                'description' => 'Manages routes, vehicles, drivers, and transport allocations.',
                'features' => ['Routes', 'Vehicles', 'Drivers', 'Allocations'],
                'dependencies' => ['student'],
                'permissions' => ['transport.view', 'transport.manage'],
                'version' => '1.0.0',
                'price' => 700,
            ],

            [
                'key' => 'patient',
                'name' => 'Patient',
                'category' => 'Healthcare',
                'icon' => 'heart-pulse',
                'short_description' => 'Patient management system.',
                'description' => 'Handles patient profiles, medical records, appointments, and healthcare workflows.',
                'features' => ['Profiles', 'Medical records', 'Appointments', 'History'],
                'dependencies' => [],
                'permissions' => ['patient.view', 'patient.create'],
                'version' => '1.0.0',
                'price' => 1200,
            ],

            [
                'key' => 'treatment',
                'name' => 'Treatment',
                'category' => 'Healthcare',
                'icon' => 'stethoscope',
                'short_description' => 'Treatment workflow management.',
                'description' => 'Manages treatment plans, procedures, prescriptions, and doctor notes.',
                'features' => ['Treatments', 'Prescriptions', 'Procedures', 'Doctor notes'],
                'dependencies' => ['patient'],
                'permissions' => ['treatment.view', 'treatment.manage'],
                'version' => '1.0.0',
                'price' => 900,
            ],

            [
                'key' => 'visitactivity',
                'name' => 'Visit Activity',
                'category' => 'Healthcare',
                'icon' => 'activity',
                'short_description' => 'Visit activity tracking.',
                'description' => 'Tracks patient visits, consultations, follow-ups, and activity logs.',
                'features' => ['Visits', 'Consultations', 'Follow-ups', 'Logs'],
                'dependencies' => ['patient'],
                'permissions' => ['visitactivity.view', 'visitactivity.manage'],
                'version' => '1.0.0',
                'price' => 600,
            ],

            [
                'key' => 'visitplanner',
                'name' => 'Visit Planner',
                'category' => 'Healthcare',
                'icon' => 'calendar-clock',
                'short_description' => 'Visit scheduling system.',
                'description' => 'Schedules appointments, follow-ups, reminders, and patient visits.',
                'features' => ['Scheduling', 'Reminders', 'Planning', 'Follow-ups'],
                'dependencies' => ['patient'],
                'permissions' => ['visitplanner.view', 'visitplanner.manage'],
                'version' => '1.0.0',
                'price' => 600,
            ],

            [
                'key' => 'employee',
                'name' => 'Employee',
                'category' => 'HR',
                'icon' => 'users',
                'short_description' => 'Employee management system.',
                'description' => 'Handles employee profiles, departments, onboarding, and workforce management.',
                'features' => ['Employees', 'Departments', 'Onboarding', 'Records'],
                'dependencies' => [],
                'permissions' => ['employee.view', 'employee.create'],
                'version' => '1.0.0',
                'price' => 1000,
            ],

            [
                'key' => 'leaveapplication',
                'name' => 'Leave Application',
                'category' => 'HR',
                'icon' => 'calendar-minus',
                'short_description' => 'Leave management system.',
                'description' => 'Handles leave requests, approvals, balances, and leave tracking.',
                'features' => ['Leave requests', 'Approvals', 'Balances', 'Tracking'],
                'dependencies' => ['employee'],
                'permissions' => ['leave.view', 'leave.apply'],
                'version' => '1.0.0',
                'price' => 500,
            ],

            [
                'key' => 'meetingmanager',
                'name' => 'Meeting Manager',
                'category' => 'HR',
                'icon' => 'presentation',
                'short_description' => 'Meeting scheduling system.',
                'description' => 'Schedules meetings, agendas, attendees, and reminders.',
                'features' => ['Meetings', 'Agendas', 'Attendees', 'Reminders'],
                'dependencies' => ['employee'],
                'permissions' => ['meeting.view', 'meeting.create'],
                'version' => '1.0.0',
                'price' => 500,
            ],

            [
                'key' => 'note',
                'name' => 'Notes',
                'category' => 'Utility',
                'icon' => 'sticky-note',
                'short_description' => 'Notes management system.',
                'description' => 'Allows users to create and manage notes and documentation.',
                'features' => ['Notes', 'Tags', 'Sharing', 'Organization'],
                'dependencies' => [],
                'permissions' => ['note.view', 'note.create'],
                'version' => '1.0.0',
                'price' => 300,
            ],

            [
                'key' => 'checklist',
                'name' => 'Checklist',
                'category' => 'Utility',
                'icon' => 'list-checks',
                'short_description' => 'Checklist and task tracking.',
                'description' => 'Manages checklists, tasks, reminders, and completion tracking.',
                'features' => ['Tasks', 'Tracking', 'Reminders', 'Checklists'],
                'dependencies' => [],
                'permissions' => ['checklist.view', 'checklist.create'],
                'version' => '1.0.0',
                'price' => 300,
            ],

            [
                'key' => 'announcement',
                'name' => 'Announcement',
                'category' => 'Communication',
                'icon' => 'megaphone',
                'short_description' => 'Announcement broadcasting system.',
                'description' => 'Broadcasts announcements, notices, alerts, and updates.',
                'features' => ['Announcements', 'Alerts', 'Broadcasts', 'Notices'],
                'dependencies' => [],
                'permissions' => ['announcement.view', 'announcement.create'],
                'version' => '1.0.0',
                'price' => 400,
            ],

            [
                'key' => 'communication',
                'name' => 'Communication',
                'category' => 'Communication',
                'icon' => 'messages-square',
                'short_description' => 'Communication and messaging tools.',
                'description' => 'Provides messaging, notifications, email, and SMS communication.',
                'features' => ['Messaging', 'Emails', 'SMS', 'Notifications'],
                'dependencies' => [],
                'permissions' => ['communication.view', 'communication.send'],
                'version' => '1.0.0',
                'price' => 600,
            ],

            [
                'key' => 'survey',
                'name' => 'Survey',
                'category' => 'Communication',
                'icon' => 'clipboard-list',
                'short_description' => 'Survey and feedback system.',
                'description' => 'Creates surveys, collects responses, and generates feedback analytics.',
                'features' => ['Surveys', 'Responses', 'Analytics', 'Polls'],
                'dependencies' => [],
                'permissions' => ['survey.view', 'survey.create'],
                'version' => '1.0.0',
                'price' => 500,
            ],

            [
                'key' => 'lead',
                'name' => 'Lead Management',
                'category' => 'CRM',
                'icon' => 'briefcase',
                'short_description' => 'Sales lead tracking system.',
                'description' => 'Tracks leads, follow-ups, conversions, pipelines, and sales activities.',
                'features' => ['Lead tracking', 'Sales pipeline', 'Follow-ups', 'Analytics'],
                'dependencies' => [],
                'permissions' => ['lead.view', 'lead.create', 'lead.edit'],
                'version' => '1.0.0',
                'price' => 900,
            ],

            [
                'key' => 'customer',
                'name' => 'Customer',
                'category' => 'CRM',
                'icon' => 'user-round',
                'short_description' => 'Customer relationship management.',
                'description' => 'Manages customer profiles, communication history, and engagement tracking.',
                'features' => ['Profiles', 'Interactions', 'Support', 'Tracking'],
                'dependencies' => [],
                'permissions' => ['customer.view', 'customer.create'],
                'version' => '1.0.0',
                'price' => 900,
            ],

            [
                'key' => 'contact',
                'name' => 'Contact',
                'category' => 'CRM',
                'icon' => 'contact-round',
                'short_description' => 'Contact management system.',
                'description' => 'Stores and manages contacts, phone numbers, emails, and organizations.',
                'features' => ['Contacts', 'Phone numbers', 'Emails', 'Organizations'],
                'dependencies' => [],
                'permissions' => ['contact.view', 'contact.create'],
                'version' => '1.0.0',
                'price' => 600,
            ],

            [
                'key' => 'product',
                'name' => 'Product',
                'category' => 'Sales',
                'icon' => 'package',
                'short_description' => 'Product catalog management.',
                'description' => 'Manages products, pricing, categories, inventory, and product details.',
                'features' => ['Catalog', 'Pricing', 'Inventory', 'Categories'],
                'dependencies' => [],
                'permissions' => ['product.view', 'product.create'],
                'version' => '1.0.0',
                'price' => 800,
            ],

            [
                'key' => 'service',
                'name' => 'Service',
                'category' => 'Sales',
                'icon' => 'briefcase-business',
                'short_description' => 'Service management system.',
                'description' => 'Handles services, packages, pricing, and service workflows.',
                'features' => ['Services', 'Packages', 'Pricing', 'Workflows'],
                'dependencies' => [],
                'permissions' => ['service.view', 'service.create'],
                'version' => '1.0.0',
                'price' => 700,
            ],

            [
                'key' => 'saleservice',
                'name' => 'Sale Service',
                'category' => 'Sales',
                'icon' => 'badge-dollar-sign',
                'short_description' => 'After-sales service management.',
                'description' => 'Tracks warranties, support, maintenance, and after-sales workflows.',
                'features' => ['Warranties', 'Support', 'Maintenance', 'Tracking'],
                'dependencies' => [],
                'permissions' => ['saleservice.view', 'saleservice.manage'],
                'version' => '1.0.0',
                'price' => 700,
            ],

            [
                'key' => 'vendor',
                'name' => 'Vendor',
                'category' => 'Procurement',
                'icon' => 'truck',
                'short_description' => 'Vendor and supplier management.',
                'description' => 'Handles vendor profiles, procurement, contracts, and supplier tracking.',
                'features' => ['Vendors', 'Suppliers', 'Contracts', 'Procurement'],
                'dependencies' => [],
                'permissions' => ['vendor.view', 'vendor.create'],
                'version' => '1.0.0',
                'price' => 700,
            ],

            [
                'key' => 'booking',
                'name' => 'Booking',
                'category' => 'Operations',
                'icon' => 'calendar-range',
                'short_description' => 'Booking and reservation management.',
                'description' => 'Handles reservations, appointments, slot management, and scheduling.',
                'features' => ['Bookings', 'Reservations', 'Scheduling', 'Slots'],
                'dependencies' => [],
                'permissions' => ['booking.view', 'booking.create'],
                'version' => '1.0.0',
                'price' => 800,
            ],

            [
                'key' => 'registration',
                'name' => 'Registration',
                'category' => 'Operations',
                'icon' => 'clipboard-signature',
                'short_description' => 'Registration workflow system.',
                'description' => 'Handles registrations, onboarding forms, approvals, and workflows.',
                'features' => ['Registrations', 'Forms', 'Approvals', 'Workflows'],
                'dependencies' => [],
                'permissions' => ['registration.view', 'registration.create'],
                'version' => '1.0.0',
                'price' => 600,
            ],

            [
                'key' => 'listing',
                'name' => 'Listing',
                'category' => 'Operations',
                'icon' => 'list',
                'short_description' => 'Listing and directory management.',
                'description' => 'Manages listings, catalogs, directories, and searchable records.',
                'features' => ['Listings', 'Catalogs', 'Directories', 'Search'],
                'dependencies' => [],
                'permissions' => ['listing.view', 'listing.create'],
                'version' => '1.0.0',
                'price' => 500,
            ],

            [
                'key' => 'eventmanager',
                'name' => 'Event Manager',
                'category' => 'Operations',
                'icon' => 'calendar-heart',
                'short_description' => 'Event planning and management.',
                'description' => 'Organizes events, attendees, registrations, tickets, and schedules.',
                'features' => ['Events', 'Attendees', 'Registrations', 'Tickets'],
                'dependencies' => [],
                'permissions' => ['event.view', 'event.manage'],
                'version' => '1.0.0',
                'price' => 800,
            ],

            [
                'key' => 'cashflow',
                'name' => 'Cashflow',
                'category' => 'Finance',
                'icon' => 'wallet',
                'short_description' => 'Cashflow and finance tracking.',
                'description' => 'Tracks income, expenses, financial transactions, and reports.',
                'features' => ['Income', 'Expenses', 'Transactions', 'Reports'],
                'dependencies' => [],
                'permissions' => ['cashflow.view', 'cashflow.manage'],
                'version' => '1.0.0',
                'price' => 900,
            ],

            [
                'key' => 'signup',
                'name' => 'Signup',
                'category' => 'Utility',
                'icon' => 'user-plus',
                'short_description' => 'Public signup and onboarding.',
                'description' => 'Handles public registrations, onboarding, and signup workflows.',
                'features' => ['Signup', 'Onboarding', 'Registration', 'Automation'],
                'dependencies' => [],
                'permissions' => [],
                'version' => '1.0.0',
                'price' => null,
                'is_billable' => false,
            ],

            [
                'key' => 'test',
                'name' => 'Test',
                'category' => 'Utility',
                'icon' => 'flask-conical',
                'short_description' => 'Testing and development module.',
                'description' => 'Used for QA testing, feature validation, experiments, and development workflows.',
                'features' => ['Testing', 'Validation', 'QA', 'Experiments'],
                'dependencies' => [],
                'permissions' => [],
                'version' => '1.0.0',
                'price' => null,
                'is_billable' => false,
            ],

            [
                'key' => 'asset',
                'name' => 'Asset',
                'category' => 'Operations',
                'icon' => 'boxes',
                'short_description' => 'Asset management system.',
                'description' => 'Manages company assets, tracking, allocation, depreciation, and asset lifecycle workflows.',
                'features' => ['Assets', 'Tracking', 'Allocation', 'Depreciation'],
                'dependencies' => [],
                'permissions' => ['asset.view', 'asset.create', 'asset.manage'],
                'version' => '1.0.0',
                'price' => 900,
            ],

            [
                'key' => 'center',
                'name' => 'Center',
                'category' => 'Operations',
                'icon' => 'building-2',
                'short_description' => 'Center and branch management.',
                'description' => 'Handles centers, branches, locations, departments, and operational units.',
                'features' => ['Centers', 'Branches', 'Departments', 'Locations'],
                'dependencies' => [],
                'permissions' => ['center.view', 'center.create', 'center.manage'],
                'version' => '1.0.0',
                'price' => 800,
            ],

            [
                'key' => 'consultation',
                'name' => 'Consultation',
                'category' => 'Healthcare',
                'icon' => 'message-circle-heart',
                'short_description' => 'Consultation management system.',
                'description' => 'Handles patient consultations, doctor notes, observations, and consultation workflows.',
                'features' => ['Consultations', 'Doctor notes', 'Observations', 'History'],
                'dependencies' => ['patient'],
                'permissions' => ['consultation.view', 'consultation.create', 'consultation.manage'],
                'version' => '1.0.0',
                'price' => 700,
            ],

            [
                'key' => 'incident',
                'name' => 'Incident',
                'category' => 'Operations',
                'icon' => 'shield-alert',
                'short_description' => 'Incident and issue management.',
                'description' => 'Tracks incidents, complaints, escalations, investigations, and resolutions.',
                'features' => ['Incidents', 'Complaints', 'Escalations', 'Resolutions'],
                'dependencies' => [],
                'permissions' => ['incident.view', 'incident.create', 'incident.manage'],
                'version' => '1.0.0',
                'price' => 700,
            ],

            [
                'key' => 'inventory',
                'name' => 'Inventory',
                'category' => 'Operations',
                'icon' => 'warehouse',
                'short_description' => 'Inventory and stock management.',
                'description' => 'Manages stock, warehouses, inventory movement, and inventory tracking workflows.',
                'features' => ['Stock', 'Warehouses', 'Inventory tracking', 'Transfers'],
                'dependencies' => ['product'],
                'permissions' => ['inventory.view', 'inventory.create', 'inventory.manage'],
                'version' => '1.0.0',
                'price' => 1000,
            ],

            [
                'key' => 'maintenance',
                'name' => 'Maintenance',
                'category' => 'Operations',
                'icon' => 'wrench',
                'short_description' => 'Maintenance workflow management.',
                'description' => 'Handles maintenance requests, schedules, repairs, service logs, and maintenance workflows.',
                'features' => ['Maintenance requests', 'Repairs', 'Schedules', 'Service logs'],
                'dependencies' => ['asset'],
                'permissions' => ['maintenance.view', 'maintenance.create', 'maintenance.manage'],
                'version' => '1.0.0',
                'price' => 800,
            ],

        ];

        DB::table('modules')->upsert(

            collect($modules)->map(function ($module, $index) use ($now) {

                return [

                    'key' => $module['key'],

                    'name' => $module['name'],

                    'slug' => Str::slug($module['name']),

                    'short_description' => $module['short_description'] ?? null,

                    'description' => $module['description'] ?? null,

                    'icon' => $module['icon'] ?? null,

                    'thumbnail' => null,

                    'banner' => null,

                    'category' => $module['category'] ?? null,

                    'features' => isset($module['features'])
                        ? json_encode($module['features'])
                        : null,

                    'dependencies' => isset($module['dependencies'])
                        ? json_encode($module['dependencies'])
                        : null,

                    'permissions' => isset($module['permissions'])
                        ? json_encode($module['permissions'])
                        : null,

                    'version' => $module['version'] ?? '1.0.0',

                    'price' => $module['price'] ?? null,

                    'is_billable' => $module['is_billable'] ?? true,

                    'is_core' => $module['is_core'] ?? false,

                    'is_active' => true,

                    'is_visible' => true,

                    'sort_order' => $index + 1,

                    'created_at' => $now,

                    'updated_at' => $now,
                ];
            })->toArray(),

            ['key'],

            [
                'name',
                'slug',
                'short_description',
                'description',
                'icon',
                'thumbnail',
                'banner',
                'category',
                'features',
                'dependencies',
                'permissions',
                'version',
                'price',
                'is_billable',
                'is_core',
                'is_active',
                'is_visible',
                'sort_order',
                'updated_at',
            ]
        );
    }
}

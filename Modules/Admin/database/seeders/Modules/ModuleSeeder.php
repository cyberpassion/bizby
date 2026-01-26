<?php

namespace Modules\Admin\Database\Seeders\Modules;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ModuleSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $modules = [
            // 🔒 Core / System
            ['key' => 'admin', 'name' => 'Admin', 'price' => null, 'is_billable' => false, 'is_core' => true],
            ['key' => 'shared', 'name' => 'Shared', 'price' => null, 'is_billable' => false, 'is_core' => true],
            ['key' => 'subscription', 'name' => 'Subscription', 'price' => null, 'is_billable' => false, 'is_core' => true],

            // 🎓 Education / Institution
            ['key' => 'student', 'name' => 'Student Management', 'price' => 1500],
            ['key' => 'attendance', 'name' => 'Attendance', 'price' => 700],
            ['key' => 'timetable', 'name' => 'Timetable', 'price' => 600],
            ['key' => 'exammanager', 'name' => 'Exam Manager', 'price' => 900],
            ['key' => 'examresult', 'name' => 'Exam Result', 'price' => 700],
            ['key' => 'library', 'name' => 'Library', 'price' => 800],
            ['key' => 'transport', 'name' => 'Transport', 'price' => 700],

            // 🏥 Healthcare
            ['key' => 'patient', 'name' => 'Patient', 'price' => 1200],
            ['key' => 'treatment', 'name' => 'Treatment', 'price' => 900],
            ['key' => 'visitactivity', 'name' => 'Visit Activity', 'price' => 600],
            ['key' => 'visitplanner', 'name' => 'Visit Planner', 'price' => 600],

            // 🧑‍💼 HR & Internal
            ['key' => 'employee', 'name' => 'Employee', 'price' => 1000],
            ['key' => 'leaveapplication', 'name' => 'Leave Application', 'price' => 500],
            ['key' => 'meetingmanager', 'name' => 'Meeting Manager', 'price' => 500],
            ['key' => 'note', 'name' => 'Notes', 'price' => 300],
            ['key' => 'checklist', 'name' => 'Checklist', 'price' => 300],

            // 📢 Communication & Engagement
            ['key' => 'announcement', 'name' => 'Announcement', 'price' => 400],
            ['key' => 'communication', 'name' => 'Communication', 'price' => 600],
            ['key' => 'survey', 'name' => 'Survey', 'price' => 500],

            // 🛒 Sales / CRM
            ['key' => 'lead', 'name' => 'Lead Management', 'price' => 900],
            ['key' => 'customer', 'name' => 'Customer', 'price' => 900],
            ['key' => 'contact', 'name' => 'Contact', 'price' => 600],
            ['key' => 'product', 'name' => 'Product', 'price' => 800],
            ['key' => 'service', 'name' => 'Service', 'price' => 700],
            ['key' => 'saleservice', 'name' => 'Sale Service', 'price' => 700],
            ['key' => 'vendor', 'name' => 'Vendor', 'price' => 700],

            // 📅 Operations
            ['key' => 'booking', 'name' => 'Booking', 'price' => 800],
            ['key' => 'registration', 'name' => 'Registration', 'price' => 600],
            ['key' => 'listing', 'name' => 'Listing', 'price' => 500],
            ['key' => 'eventmanager', 'name' => 'Event Manager', 'price' => 800],

            // 💰 Finance
            ['key' => 'cashflow', 'name' => 'Cashflow', 'price' => 900],

            // 🧪 Misc / Utility
            ['key' => 'signup', 'name' => 'Signup', 'price' => null, 'is_billable' => false],
            ['key' => 'test', 'name' => 'Test', 'price' => null, 'is_billable' => false],
        ];

        DB::table('modules')->upsert(
            collect($modules)->map(fn ($m) => [
                'key'         => $m['key'],
                'name'        => $m['name'],
                'description' => $m['name'] . ' module',
                'price'       => $m['price'] ?? null,
                'is_billable' => $m['is_billable'] ?? true,
                'is_core'     => $m['is_core'] ?? false,
                'is_active'   => true,
                'created_at'  => $now,
                'updated_at'  => $now,
            ])->toArray(),
            ['key'], // unique
            ['name', 'description', 'price', 'is_billable', 'is_core', 'is_active', 'updated_at']
        );
    }
}

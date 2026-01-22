<?php

namespace Modules\Shared\Database\Seeders\Terms;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TermDepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [

            // Core Management
            'Administration',
            'Management',
            'Human Resources',
            'Finance',
            'Accounts',
            'Audit',
            'Legal',
            'Compliance',

            // Technology
            'Information Technology',
            'Software Development',
            'Engineering',
            'Infrastructure',
            'DevOps',
            'Cyber Security',
            'Data & Analytics',
            'AI / Machine Learning',
            'Quality Assurance',

            // Operations
            'Operations',
            'Project Management',
            'Program Management',
            'Supply Chain',
            'Logistics',
            'Procurement',
            'Vendor Management',

            // Sales & Marketing
            'Sales',
            'Marketing',
            'Digital Marketing',
            'Business Development',
            'Customer Success',
            'Customer Support',
            'CRM',

            // Education / Training
            'Academics',
            'Admissions',
            'Examinations',
            'Student Affairs',
            'Training & Development',
            'Placement Cell',
            'Research & Development',

            // HR Specialised
            'Recruitment',
            'Payroll',
            'Employee Relations',
            'Performance Management',
            'Learning & Development',

            // Finance Specialised
            'Treasury',
            'Taxation',
            'Billing',
            'Invoicing',
            'Budgeting',

            // Admin / Facilities
            'Facilities Management',
            'Housekeeping',
            'Security',
            'Transport',
            'Maintenance',

            // Healthcare / Safety (Optional)
            'Medical',
            'Health & Safety',
            'Wellness',

            // Media / Creative
            'Content',
            'Design',
            'UI / UX',
            'Public Relations',

            // Strategy / Leadership
            'Strategy',
            'Planning',
            'Corporate Affairs',
            'Investor Relations',

            // Misc
            'Quality Control',
            'Internal Audit',
            'Risk Management',
            'Other',
        ];

        $data = [];

        foreach ($departments as $index => $department) {
            $data[] = [
                'tenant_id'  => 1,
                'status'     => 1,
                'name'       => $department,
                'slug'       => Str::slug($department),
                'group'      => 'departments',
                'module'     => 'shared',
                'sort_order' => $index + 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('terms')->upsert(
            $data,
            ['slug', 'tenant_id'],
            ['status', 'updated_at']
        );
    }
}

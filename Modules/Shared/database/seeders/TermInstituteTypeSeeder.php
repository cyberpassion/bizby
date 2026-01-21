<?php

namespace Modules\Shared\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TermInstituteTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [

            // School Level
            'Play School',
            'Pre-Primary School',
            'Primary School',
            'Middle School',
            'High School',
            'Senior Secondary School',

            // Higher Education
            'College',
            'Degree College',
            'Autonomous College',
            'University',
            'Deemed University',

            // Professional / Technical
            'Engineering College',
            'Medical College',
            'Dental College',
            'Nursing College',
            'Pharmacy College',
            'Law College',
            'Management Institute',
            'Polytechnic',
            'ITI',

            // Training / Coaching
            'Coaching Institute',
            'Training Center',
            'Skill Development Center',
            'Vocational Training Institute',

            // Research / Special
            'Research Institute',
            'Teacher Training Institute',
            'Special Education Institute',

            // Others
            'Online Learning Institute',
            'Distance Learning Institute',
            'Open School',
            'Other',
        ];

        $data = [];

        foreach ($types as $index => $type) {
            $data[] = [
                'tenant_id'  => 1,
                'status'     => 1,
                'name'       => $type,
                'slug'       => Str::slug($type),
                'group'      => 'institute-types',
                'module'     => 'student',
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

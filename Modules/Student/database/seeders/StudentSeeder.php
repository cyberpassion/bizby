<?php

namespace Modules\Student\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('students')->insert([
            [
                'client_id' => 1,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => null,
                'deleted_at' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

                'entry_source' => 'system',
                'entry_source_ref_id' => null,
                'remark' => 'Initial seed data',
                'system_remark' => 'System generated record',
                'meta_info' => json_encode(['ip' => '127.0.0.1']),

                'name' => 'Rahul Sharma',
                'gender' => 'Male',
                'dob' => '2005-06-15',
                'age' => 19,
                'phone' => '9876543210',
                'email' => 'rahul@example.com',
                'verification_id_name' => 'Aadhar',
                'verification_id_number' => '1234-5678-9012',
                'address' => 'Mathura, Uttar Pradesh',
                'religion' => 'Hindu',
                'caste' => 'Brahmin',
                'category' => 'General',
                'nationality' => 'Indian',
                'marital_status' => 0,
                'class_id' => 3,
                'academic_year' => '2024-2025'
            ],
            [
                'client_id' => 1,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => null,
                'deleted_at' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

                'entry_source' => 'web',
                'entry_source_ref_id' => null,
                'remark' => 'Second seed record',
                'system_remark' => 'Seed insert',
                'meta_info' => json_encode(['device' => 'desktop']),

                'name' => 'Priya Verma',
                'gender' => 'Female',
                'dob' => '2006-02-20',
                'age' => 18,
                'phone' => '9898989898',
                'email' => 'priya@example.com',
                'verification_id_name' => 'Aadhar',
                'verification_id_number' => '1111-2222-3333',
                'address' => 'Agra, Uttar Pradesh',
                'religion' => 'Hindu',
                'caste' => 'Kurmi',
                'category' => 'OBC',
                'nationality' => 'Indian',
                'marital_status' => 0,
                'class_id' => 4,
                'academic_year' => '2024-2025'
            ]
        ]);
    }
}

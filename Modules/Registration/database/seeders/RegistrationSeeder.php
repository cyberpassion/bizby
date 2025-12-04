<?php

namespace Modules\Registration\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RegistrationSeeder extends Seeder
{
    public function run()
    {
        DB::table('registrations')->insert([
            [
                'client_id'             => 1,
                'status'                => 1,
                'created_by'            => 1,
                'updated_by'            => 1,
                'deleted_by'            => null,
                'deleted_at'            => null,

                'entry_source'          => 'system',
                'entry_source_ref_id'   => null,
                'remark'                => 'Initial registration entry',
                'system_remark'         => 'Seeder generated record',
                'meta_info'             => json_encode([
                    'ip' => '127.0.0.1',
                    'device' => 'Seeder',
                ]),

                'registration_type'     => 'OPD',
                'session'               => '2024-25',

                'name'                  => 'Rahul Sharma',
                'gender'                => 'Male',
                'dob'                   => '1995-08-15',
                'age'                   => 29,
                'phone'                 => '9876543210',
                'email'                 => 'rahul@example.com',

                'verification_id_name'  => 'Aadhar',
                'verification_id_number'=> '1234 5678 9012',

                'address'               => 'Mathura, Uttar Pradesh',
                'religion'              => 'Hindu',
                'caste'                 => 'General',
                'category'              => 'General',
                'nationality'           => 'Indian',
                'marital_status'        => 1,

                'created_at'            => now(),
                'updated_at'            => now(),
            ],

            [
                'client_id'             => 1,
                'status'                => 1,
                'created_by'            => 1,
                'updated_by'            => 1,
                'deleted_by'            => null,
                'deleted_at'            => null,

                'entry_source'          => 'system',
                'entry_source_ref_id'   => null,
                'remark'                => 'Second registration entry',
                'system_remark'         => 'Seeder generated record',
                'meta_info'             => json_encode([
                    'ip' => '127.0.0.1',
                    'device' => 'Seeder',
                ]),

                'registration_type'     => 'IPD',
                'session'               => '2024-25',

                'name'                  => 'Priya Verma',
                'gender'                => 'Female',
                'dob'                   => '1998-03-12',
                'age'                   => 26,
                'phone'                 => '9876501234',
                'email'                 => 'priya@example.com',

                'verification_id_name'  => 'PAN',
                'verification_id_number'=> 'ABCDE1234F',

                'address'               => 'Delhi NCR',
                'religion'              => 'Hindu',
                'caste'                 => 'OBC',
                'category'              => 'OBC',
                'nationality'           => 'Indian',
                'marital_status'        => 0,

                'created_at'            => now(),
                'updated_at'            => now(),
            ]
        ]);
    }
}

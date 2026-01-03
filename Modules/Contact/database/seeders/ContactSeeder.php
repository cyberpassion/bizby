<?php

namespace Modules\Contact\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('contacts')->insert([
            [
                // ===== commonSaasFields =====
                'client_id'           => 1,
                'status'              => 1,
                'created_by'          => 1,
                'updated_by'          => 1,
                'created_at'          => now(),
                'updated_at'          => now(),
                'entry_source'        => 'system',
                'entry_source_ref_id' => null,
                'remark'              => 'Initial contact seed',
                'system_remark'       => 'Seeder generated record',
                'meta'           => json_encode(['seed' => true]),

                // ===== reference fields =====
                'reference_name'      => 'Patient',
                'reference_id'        => 101,

                // ===== commonPersonFields =====
                'name'                => 'Rahul Sharma',
                'gender'              => 'Male',
                'dob'                 => '1995-05-10',
                'age'                 => 29,
                'phone'               => '9876543210',
                'email'               => 'rahul.sharma@example.com',
                'verification_id_name'=> 'Aadhar',
                'verification_id_number' => '1234-5678-9012',
                'address'             => 'Mathura, Uttar Pradesh, India',
                'religion'            => 'Hindu',
                'caste'               => 'General',
                'category'            => 'General',
                'nationality'         => 'Indian',
                'marital_status'      => 0,
            ],
            [
                'client_id'           => 1,
                'status'              => 1,
                'created_by'          => 1,
                'updated_by'          => 1,
                'created_at'          => now(),
                'updated_at'          => now(),
                'entry_source'        => 'system',
                'entry_source_ref_id' => null,
                'remark'              => 'Initial contact seed',
                'system_remark'       => 'Seeder generated record',
                'meta'           => json_encode(['seed' => true]),

                'reference_name'      => 'Visitor',
                'reference_id'        => 202,

                'name'                => 'Neha Verma',
                'gender'              => 'Female',
                'dob'                 => '1998-09-15',
                'age'                 => 26,
                'phone'               => '9123456789',
                'email'               => 'neha.verma@example.com',
                'verification_id_name'=> 'PAN',
                'verification_id_number' => 'ABCDE1234F',
                'address'             => 'Agra, Uttar Pradesh, India',
                'religion'            => 'Hindu',
                'caste'               => 'OBC',
                'category'            => 'OBC',
                'nationality'         => 'Indian',
                'marital_status'      => 1,
            ],
        ]);
    }
}

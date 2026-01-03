<?php

namespace Modules\Customer\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('customers')->insert([

            [
                // SaaS Common Fields
                'client_id' => 1,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => null,
                'deleted_at' => null,
                'created_at' => now(),
                'updated_at' => now(),

                'entry_source' => 'web',
                'entry_source_ref_id' => null,
                'remark' => 'First customer added',
                'system_remark' => null,
                'meta' => json_encode(['ip' => '127.0.0.1']),

                // Custom Fields
                'business_type' => 'Retail',
                'customer_type' => 'Premium',

                // commonPersonFields()
                'name' => 'Amit Verma',
                'gender' => 'Male',
                'dob' => '1988-07-14',
                'age' => 36,
                'phone' => '9876541230',
                'email' => 'amit@example.com',
                'verification_id_name' => 'Aadhar',
                'verification_id_number' => '1234-5678-9012',
                'address' => 'Sector 10, Noida, India',
                'religion' => 'Hindu',
                'caste' => 'General',
                'category' => 'General',
                'nationality' => 'Indian',
                'marital_status' => 1,

                'reference' => 'Referred by Rajesh',
                'next_date' => '2025-03-01',

                'state' => 'Uttar Pradesh',
                'gstin' => '09ABCDE1234F1Z5',
                'district' => 'Gautam Buddha Nagar',
            ],

            [
                'client_id' => 1,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => null,
                'deleted_at' => null,
                'created_at' => now(),
                'updated_at' => now(),

                'entry_source' => 'mobile',
                'entry_source_ref_id' => 2,
                'remark' => 'Mobile entry',
                'system_remark' => 'Synced from mobile app',
                'meta' => json_encode(['device' => 'Android']),

                'business_type' => 'Wholesale',
                'customer_type' => 'Regular',

                'name' => 'Priya Sharma',
                'gender' => 'Female',
                'dob' => '1992-11-20',
                'age' => 32,
                'phone' => '9988776655',
                'email' => 'priya@example.com',
                'verification_id_name' => 'PAN',
                'verification_id_number' => 'ABCDE1234F',
                'address' => 'Bandra West, Mumbai',
                'religion' => 'Hindu',
                'caste' => 'OBC',
                'category' => 'OBC',
                'nationality' => 'Indian',
                'marital_status' => 0,

                'reference' => 'Online lead',
                'next_date' => '2025-03-05',

                'state' => 'Maharashtra',
                'gstin' => '27ABCDE1234F1Z5',
                'district' => 'Mumbai Suburban',
            ]

        ]);
    }
}

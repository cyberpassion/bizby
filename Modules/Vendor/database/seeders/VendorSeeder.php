<?php

namespace Modules\Vendor\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class VendorSeeder extends Seeder
{
    public function run()
    {
        DB::table('vendors')->insert([
            [
                'tenant_id' => 1,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'entry_source' => 'system',
                'entry_source_ref_id' => null,
                'remark' => 'Default Vendor Added',
                'system_remark' => 'Seeder entry',
                'meta' => null,

                'vendor_type' => 'Distributor',
                'vendor_code' => 'VND-' . rand(1000,9999),
                'vendor_parent_id' => null,

                'name' => 'ABC Traders',
                'gender' => 'Other',
                'dob' => '1990-01-01',
                'age' => 34,
                'phone' => '9876543210',
                'email' => 'vendor@example.com',
                'verification_id_name' => 'GSTIN',
                'verification_id_number' => '22AAAAA0000A1Z5',
                'address' => 'Main Market, Delhi',
                'religion' => null,
                'caste' => null,
                'category' => null,
                'nationality' => 'Indian',
                'marital_status' => 1,

                'vendor_gstin' => '22AAAAA0000A1Z5',
                'vendor_pan' => 'ABCDE1234F',
                'vendor_info' => 'Trusted supplier since 2010',
                'vendor_bank_info' => 'Bank: SBI, A/C: 1234567890',
                'vendor_terms_and_condition' => 'Standard payment terms apply',
                'region' => 'North',
                'vendor_person' => 'Rohit Sharma',
                'vendor_person_designation' => 'Sales Manager',
                'vendor_person_phone' => '9999988888',
                'vendor_person_email' => 'rohit.sharma@example.com',

                'state' => 'Delhi',
                'district' => 'New Delhi',
                'sales' => '1200000',
                'thread_parent' => null,
                'incentive_percentage' => 5.5,

                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}

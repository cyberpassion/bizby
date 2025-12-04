<?php

namespace Modules\Lead\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LeadSeeder extends Seeder
{
    public function run()
    {
        DB::table('leads')->insert([
            [
                'client_id' => 1,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'entry_source' => 'system',
                'entry_source_ref_id' => null,
                'remark' => null,
                'system_remark' => null,
                'meta_info' => null,

                // Lead-specific fields
                'lead_id' => 1001,

                'generated_by_type' => 'employee',
                'generated_by' => 'Ravi Sharma',

                'product' => 'Website Development',
                'product_info' => 'Dynamic CMS Website',

                'potential_client_name' => 'Govt Department',
                'potential_client_contact_person' => 'Amit Kumar',

                'district' => 'Mathura',
                'state' => 'Uttar Pradesh',

                'potential_client_address' => 'Civil Lines, Mathura',
                'potential_client_pincode' => '281001',
                'potential_client_mobile_number' => '9876543210',
                'potential_client_email' => 'dept@example.com',

                'contact_by_type' => 'employee',
                'contact_by' => 'Ravi Sharma',

                'contact_date' => '2025-01-10',
                'contact_mode' => 'Visit',
                'contact_reference_number' => 'REF-2025-1001',

                'contact_response' => 'Interested in proposal',
                'contact_remark' => 'Asked for detailed quotation',

                'contact_after' => 'Follow-up after 7 days',
                'reference' => 'Cold Visit',
                'is_existing_client' => 'No',
                'expectation' => 'Complete website revamp',

                'next_date' => '2025-01-17',

                'thread_parent' => 0,
                'visitplanner_id' => 1,

                'potential_client_website' => 'https://department.gov.in',
                'progress' => 'In Progress',

                'visit_date' => '2025-01-10',

                'category' => 'Government',
                'potential_client_place' => 'Mathura',
                'potential_client_state' => 'Uttar Pradesh',

                'generated_by_id' => 1,
                'contact_by_id' => 1,

                'place' => 'Office',
                'entry_source_type' => 'lead_form',

                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'client_id' => 1,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'entry_source' => 'web',
                'entry_source_ref_id' => null,
                'remark' => null,
                'system_remark' => null,
                'meta_info' => null,

                'lead_id' => 1002,

                'generated_by_type' => 'employee',
                'generated_by' => 'Reetu Chaudhary',

                'product' => 'Mobile App Development',
                'product_info' => 'Android + iOS App',

                'potential_client_name' => 'Private School',
                'potential_client_contact_person' => 'Vikas Singh',

                'district' => 'Agra',
                'state' => 'Uttar Pradesh',

                'potential_client_address' => 'Dayalbagh, Agra',
                'potential_client_pincode' => '282005',
                'potential_client_mobile_number' => '9123456789',
                'potential_client_email' => 'contact@school.com',

                'contact_by_type' => 'employee',
                'contact_by' => 'Reetu Chaudhary',

                'contact_date' => '2025-01-11',
                'contact_mode' => 'Phone',
                'contact_reference_number' => 'REF-2025-1002',

                'contact_response' => 'Asked for demo',
                'contact_remark' => 'Meeting scheduled next week',

                'contact_after' => 'Call after 3 days',
                'reference' => 'Online Enquiry',
                'is_existing_client' => 'No',
                'expectation' => 'School management app',

                'next_date' => '2025-01-14',

                'thread_parent' => 0,
                'visitplanner_id' => 2,

                'potential_client_website' => null,
                'progress' => 'Pending',

                'visit_date' => null,

                'category' => 'Private',
                'potential_client_place' => 'Agra',
                'potential_client_state' => 'Uttar Pradesh',

                'generated_by_id' => 2,
                'contact_by_id' => 2,

                'place' => 'Phone Call',
                'entry_source_type' => 'web_form',

                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}


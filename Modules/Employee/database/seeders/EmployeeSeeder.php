<?php

namespace Modules\Employee\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('employees')->insert([

            [
                // ========== SaaS Common Fields ==========
                'tenant_id' => 1,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => null,
                'deleted_at' => null,
                'created_at' => now(),
                'updated_at' => now(),

                'entry_source' => 'web',
                'entry_source_ref_id' => null,
                'remark' => 'Employee added manually',
                'system_remark' => null,
                'meta' => json_encode(['ip' => '127.0.0.1']),


                // ========== Module-Specific Fields ==========
                'employee_type' => 'Full-Time',

                // ========== commonPersonFields() ==========
                'name' => 'Rahul Singh',
                'gender' => 'Male',
                'dob' => '1990-05-12',
                'age' => 34,
                'phone' => '9876543210',
                'email' => 'rahul.singh@example.com',
                'verification_id_name' => 'Aadhar',
                'verification_id_number' => '1234-5678-9012',
                'address' => 'Lucknow, Uttar Pradesh',
                'religion' => 'Hindu',
                'caste' => 'General',
                'category' => 'General',
                'nationality' => 'Indian',
                'marital_status' => 1,

                // ========== Remaining Employee Fields ==========
                'spouse_name' => 'Neha Singh',
                'qualifications' => 'B.Tech, M.Tech',
                'pan_number' => 'ABCDE1234F',
                'aadhar_number' => '1234-5678-9012',
                'driving_license_number' => 'DL-0420110012345',
                'voter_id_card_number' => 'UP/12/123/456',
                'passport_number' => 'N9876543',
                'pf_account_number' => 'PF123456789',

                'bank_name' => 'State Bank of India',
                'bank_branch_name' => 'Hazratganj',
                'bank_ifsc_code' => 'SBIN0000123',
                'bank_account_number' => '123456789012',

                'current_address' => 'Gomti Nagar, Lucknow',
                'designation' => 'Software Engineer',

                'date_of_joining' => '2020-01-10',
                'date_of_relieving' => null,

                'past_work_experience' => 'Worked at ABC Pvt Ltd (2 years).',

                'punch_id' => 101,

                'teaching_exam_qualified' => null,
                'secondary_passing_year' => '2006',
                'secondary_passing_roll_no' => '123456',

                'qualification_level' => 'Postgraduate',
                'educational_qualification' => 'M.Tech in Computer Science',
                'professional_qualification' => 'Certified Java Developer',

                'job_location' => 'Lucknow Office',
                'job_responsibility' => 'Development & Maintenance',

                'first_salary' => '25000',
                'current_salary' => '65000',
            ],


            [
                // ========== SaaS Common Fields ==========
                'tenant_id' => 1,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => null,
                'deleted_at' => null,
                'created_at' => now(),
                'updated_at' => now(),

                'entry_source' => 'system',
                'entry_source_ref_id' => 2,
                'remark' => 'Auto-sync employee',
                'system_remark' => 'Synced from HRMS App',
                'meta' => json_encode(['device' => 'Android']),


                // ========== Module-Specific Fields ==========
                'employee_type' => 'Contract',

                // ========== commonPersonFields() ==========
                'name' => 'Priya Mehta',
                'gender' => 'Female',
                'dob' => '1995-09-20',
                'age' => 29,
                'phone' => '9988776655',
                'email' => 'priya.mehta@example.com',
                'verification_id_name' => 'PAN',
                'verification_id_number' => 'XYZAB9876Q',
                'address' => 'Delhi NCR',
                'religion' => 'Hindu',
                'caste' => 'OBC',
                'category' => 'OBC',
                'nationality' => 'Indian',
                'marital_status' => 0,

                'spouse_name' => null,
                'qualifications' => 'MBA HR',
                'pan_number' => 'XYZAB9876Q',
                'aadhar_number' => '7894-5612-3490',
                'driving_license_number' => null,
                'voter_id_card_number' => null,
                'passport_number' => null,
                'pf_account_number' => 'PF909080807',

                'bank_name' => 'HDFC Bank',
                'bank_branch_name' => 'Noida Sector 18',
                'bank_ifsc_code' => 'HDFC0000123',
                'bank_account_number' => '987654321000',

                'current_address' => 'Noida Sector 50',
                'designation' => 'HR Executive',

                'date_of_joining' => '2022-03-15',
                'date_of_relieving' => null,

                'past_work_experience' => '3 years in HR Operations',

                'punch_id' => 202,

                'teaching_exam_qualified' => null,
                'secondary_passing_year' => '2010',
                'secondary_passing_roll_no' => '908776',

                'qualification_level' => 'Graduate',
                'educational_qualification' => 'BBA',
                'professional_qualification' => 'HR Certification',

                'job_location' => 'Noida',
                'job_responsibility' => 'Recruitment & Employee Relations',

                'first_salary' => '18000',
                'current_salary' => '32000',
            ]

        ]);
    }
}

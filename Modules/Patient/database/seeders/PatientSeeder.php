<?php

namespace Modules\Patient\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('patients')->insert([
            [
                'client_id' => 1,
                'status' => 1,

                // Person Fields
                'name' => 'Rohan Sharma',
                'gender' => 'Male',
                'dob' => '1995-06-15',
                'age' => 29,
                'phone' => '9876543210',
                'email' => 'rohan.sharma@example.com',
                'verification_id_name' => 'Aadhar',
                'verification_id_number' => '1234-5678-9000',
                'address' => 'Mathura, Uttar Pradesh',
                'religion' => 'Hindu',
                'caste' => 'General',
                'category' => 'General',
                'nationality' => 'Indian',
                'marital_status' => 1,

                // Patient Details
                'patient_type' => 'OPD',
                'father_name' => 'Mahesh Sharma',
                'mother_name' => 'Sunita Sharma',
                'guardian_name' => 'Mahesh Sharma',
                'relation_with_guardian' => 'Father',

                // Vitals
                'height' => 170,
                'weight' => 65,
                'pulse_rate' => '82',
                'blood_pressure' => '120/80',
                'spo2' => '98',

                // Diagnosis
                'provisional_diagnosis' => 'Mild Fever and Fatigue',

                // Health Card
                'health_card' => 'ABHA',
                'health_card_number' => 'ABHA-9988776655',

                // Admission
                'admission_date' => '2025-01-10',
                'admission_time' => '10:30:00',
                'admitted_by_type' => 'Doctor',
                'admitted_by_name' => 'Dr. Amit Verma',
                'admitted_by_phone_number' => '9999988888',
                'admission_remark' => 'Patient admitted with complaints of fever.',

                // Emergency Case
                'is_emergency_case' => 'No',
                'case_name' => null,
                'fir_number' => null,

                // Room / Bed
                'room_number' => '104',
                'bed_number' => 'B1',

                // Referrals
                'referred_by' => 'Self',
                'referred_to' => 'General Physician',

                // Treatment Info
                'treatment_under' => 'Dr. Amit Verma',
                'treatment_details' => 'Paracetamol & Hydration',

                // Discharge
                'discharge_date' => '2025-01-12',
                'discharge_time' => '14:00:00',
                'discharged_by' => 1,
                'discharge_remark' => 'Patient recovered and discharged.',

                // SaaS Meta
                'entry_source' => 'web',
                'entry_source_ref_id' => null,
                'remark' => 'Sample patient entry created by seeder.',
                'system_remark' => null,
                'meta_info' => json_encode(['ip' => '127.0.0.1']),

                // Timestamps
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}

<?php

use Modules\Consultation\Models\Consultation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

// uses(TestCase::class, RefreshDatabase::class); // we don't want to refresh DB to view data

uses(TestCase::class); // we want to view data hence not refreshing DB

it('can create a consultation entry', function () {

    $data = [
        'client_id' => 1,
        'status' => 1,
        'created_by' => 1,
        'updated_by' => 1,
        'consultation_group_id' => 1,
        'consultation_date' => now()->format('Y-m-d'),
        'consultation_time' => now()->format('H:i:s'),
        'day_token_id' => 1,
        'consultation_through' => 'online',
        'consultation_with' => 2,
        'consultation_for' => 'General Checkup',
        'consultation_for_detail' => 'Routine checkup for blood pressure and sugar levels',
        'name' => 'John Doe',
        'dob' => '1990-01-01',
        'phone_number' => '9876543210',
        'email' => 'john.doe@example.com',
        'verification_id_name' => 'Aadhar',
        'verification_id_number' => '123456789012',
        'address' => '123, Main Street, City',
        'consultation_type' => 'General',
        'consultation_fee' => 500.00,
        'consultation_extra_fee' => 50.00,
        'referred_by' => 'Dr. Smith',
        'referred_to' => 'Dr. John',
        'remark' => 'Patient has mild symptoms',
        'expected_next_consultation_after' => '1 Month',
        'next_date' => now()->addMonth()->format('Y-m-d'),
        'thread_parent' => null,
    ];

    $consultation = Consultation::create($data);

    expect(Consultation::where('name', 'John Doe')->exists())->toBeTrue();
    expect($consultation)->toBeInstanceOf(Consultation::class)
                         ->and($consultation->phone_number)->toBe('9876543210');
});

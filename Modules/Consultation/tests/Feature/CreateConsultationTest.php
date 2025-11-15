<?php

use Modules\Consultation\Entities\Consultation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User; // or your user model namespace

uses(TestCase::class, RefreshDatabase::class);

test('consultation can be created', function () {
    // Create and authenticate a user
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->postJson(route('consultation.store'), [
        'consultation_with' => 'Dr. Smith',
        'consultation_date' => '2025-11-20',
        'patient_name' => 'John Doe',
        'notes' => 'Patient feels dizzy'
    ]);

    $response->assertStatus(201)
             ->assertJson([
                 'status' => 'success',
                 'message' => 'Consultation created successfully.'
             ]);

    $this->assertDatabaseHas('consultation/list', [
        'patient_name' => 'John Doe'
    ]);
});

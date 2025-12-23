<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
		    $table->id();

		    $table->foreignId('booking_venue_id')
		        ->constrained()
        		->cascadeOnDelete();

		    $table->foreignId('bookable_unit_id')
        		->constrained()
		        ->cascadeOnDelete();

		    // who booked it
		    $table->nullableMorphs('booked_by');
    		// User | Customer | Patient

		    $table->string('booking_type')->nullable();
    		// stay | slot | admission

		    $table->timestamp('start_at');
		    $table->timestamp('end_at')->nullable();
		    $table->string('status')->default('pending');
    		// pending | confirmed | cancelled | completed

		    $table->json('meta')->nullable();
		    // notes, preferences, doctor, occasion

		    $table->timestamps();

		    $table->index(['booking_venue_id', 'bookable_unit_id']);
    		$table->index(['start_at', 'end_at']);
		});

    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
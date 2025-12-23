<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('booking_unit_pricings', function (Blueprint $table) {
		    $table->id();

		    $table->foreignId('bookable_unit_id')
        		->constrained()
		        ->cascadeOnDelete();

		    $table->string('booking_type');
		    // stay | slot | admission

		    $table->string('charge_type');
		    // per_night | per_day | per_hour | per_slot

		    $table->decimal('price', 10, 2);

		    $table->timestamps();

		    $table->unique(['bookable_unit_id', 'booking_type']);
		});

    }

    public function down(): void
    {
        Schema::dropIfExists('booking_unit_pricings');
    }
};
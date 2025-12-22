<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookable_units', function (Blueprint $table) {
		    $table->id();

		    $table->foreignId('bookin_venue_id')
		        ->constrained()
        		->cascadeOnDelete();

		    $table->string('name');
		    // Room 101 | Table 4 | Bed A | Villa 3

		    $table->string('unit_type');
		    // room | table | bed | villa | desk

		    $table->integer('capacity')->nullable();
		    // persons / patients

		    $table->string('code')->nullable();
		    // internal reference

		    $table->boolean('is_active')->default(true);

		    $table->json('meta')->nullable();
    		/*
        		room: floor, ac, view
		        table: indoor/outdoor
        		bed: ICU/general
        		villa: private_pool
		    */

		    $table->timestamps();

		    $table->index(['booking_venue_id', 'unit_type']);
		});

    }

    public function down(): void
    {
        Schema::dropIfExists('bookable_units');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('booking_venues', function (Blueprint $table) {
		    $table->id();

		    // Multi-tenant (optional but recommended)
		    $table->foreignId('organization_id')->nullable()->index();

		    $table->string('name');
		    $table->string('type');
    		// hotel | restaurant | hospital | clinic | coworking

		    $table->string('address')->nullable();
		    $table->string('city')->nullable();
	    	$table->string('state')->nullable();
    		$table->string('country')->nullable();

		    $table->json('meta')->nullable();
    		// check_in_time, policies, amenities, departments

		    $table->boolean('status')->default(true);

		    $table->timestamps();
		});

    }

    public function down(): void
    {
        Schema::dropIfExists('booking_venues');
    }
};
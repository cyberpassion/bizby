<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('listing_events', function (Blueprint $table) {
		    // Common SaaS fields
    		$table->commonSaasFields();

		    $table->unsignedBigInteger('listing_id');

		    $table->string('event_type'); 
		    // view, contact_click, whatsapp_click, website_click

			$table->string('session_id')->nullable();

		    $table->string('ip')->nullable();
		    $table->string('user_agent')->nullable();

		    $table->unsignedBigInteger('user_id')->nullable();

		    $table->string('source')->nullable(); 
		    // google, direct, facebook, etc.

		    $table->index(['listing_id']);
		    $table->index(['event_type']);
			$table->index(['session_id']);
    		$table->index(['created_at']);
		});
    }

    public function down(): void
    {
        Schema::dropIfExists('listing_events');
    }
};
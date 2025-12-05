<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {

		    // Common SaaS fields
    		$table->commonSaasFields();

		    // Lead basic properties
		    $table->string('lead_code')->unique();
    		$table->string('name');
		    $table->string('contact_person')->nullable();
    		$table->string('mobile', 20)->nullable();
    		$table->string('email')->nullable();

		    // Address
    		$table->string('district')->nullable();
	    	$table->string('state')->nullable();
	    	$table->string('pincode', 20)->nullable();
    		$table->string('website')->nullable();

		    // USING MORPHS — generated_by (who added the lead)
	    	$table->nullableMorphs('generated_by'); 
	    	/*
    	    	Creates:
        		generated_by_id BIGINT NULL
        		generated_by_type VARCHAR NULL
		    */

		    // USING MORPHS — assigned_to (who is handling the lead)
    		$table->nullableMorphs('assigned_to');
		    /*
    		    Creates:
        		assigned_to_id BIGINT NULL
        		assigned_to_type VARCHAR NULL
	    	*/

		    // Lead metadata (terms)
    		$table->unsignedBigInteger('category_id')->nullable();
    		$table->unsignedBigInteger('source_id')->nullable();
	    	$table->unsignedBigInteger('stage_id')->nullable();

		    $table->boolean('is_existing_client')->default(false);
    		$table->string('place')->nullable();

		    // Next follow-up
    		$table->date('next_followup_date')->nullable();

		    // Optional thread (self-referencing)
    		$table->unsignedBigInteger('thread_parent_id')->nullable()->index();

		    // Useful indexes
    		$table->index(['mobile', 'email']);
		});

    }

    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};

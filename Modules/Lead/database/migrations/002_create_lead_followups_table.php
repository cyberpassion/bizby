<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lead_followups', function (Blueprint $table) {
		    $table->id();

		    // Parent lead
		    $table->unsignedBigInteger('lead_id');

		    // USING MORPHS — who contacted
    		$table->nullableMorphs('contact_by');
		    /*
        		contact_by_id BIGINT NULL
        		contact_by_type VARCHAR NULL
		    */

	    	// Contact details
	    	$table->dateTime('contact_date');
    		$table->string('mode', 50)->nullable(); // call / visit / whatsapp / email / sms
		    $table->string('reference_no')->nullable();

	    	$table->text('response')->nullable();
    		$table->text('remark')->nullable();

		    // Next follow-up
		    $table->date('next_followup_date')->nullable();

		    // Audit fields for SaaS
	    	$table->unsignedBigInteger('client_id')->nullable();
    		$table->unsignedBigInteger('created_by')->nullable();
		    $table->unsignedBigInteger('updated_by')->nullable();
    		$table->unsignedBigInteger('deleted_by')->nullable();

		    $table->timestamps();
		    $table->softDeletes();

		    // Indexes
		    $table->index('lead_id');
    		$table->index('contact_date');

			$table->foreign('lead_id')->references('id')->on('leads')->cascadeOnDelete();

		});

    }

    public function down(): void
    {
        Schema::dropIfExists('lead_followups');
    }
};

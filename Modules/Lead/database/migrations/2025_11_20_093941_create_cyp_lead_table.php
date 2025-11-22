<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cyp_lead', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('client_id')->unsigned();
            $table->bigInteger('lead_id')->unsigned();
            $table->date('date');
            $table->dateTime('datetime');
            $table->string('category', 255);
            $table->string('generated_by_type', 255);
            $table->bigInteger('generated_by_id')->unsigned();
            $table->string('generated_by', 255);
            $table->text('product');
            $table->text('product_info');
            $table->text('potential_client_name');
            $table->string('potential_client_contact_person', 255);
            $table->text('potential_client_address');
            $table->string('potential_client_pincode', 255);
            $table->string('potential_client_place', 255);
            $table->string('potential_client_state', 255);
            $table->string('potential_client_mobile_number', 255);
            $table->string('potential_client_website', 255);
            $table->string('potential_client_email', 255);
            $table->string('contact_by_type', 255);
            $table->bigInteger('contact_by_id')->unsigned();
            $table->string('contact_by', 255);
            $table->date('contact_date');
            $table->string('contact_mode', 255);
            $table->string('contact_reference_number', 255);
            $table->text('contact_response');
            $table->text('contact_remark');
            $table->string('contact_after', 255);
            $table->string('reference', 255);
            $table->string('is_existing_client', 255);
            $table->string('expectation', 255);
            $table->date('next_date');
            $table->bigInteger('thread_parent')->unsigned();
            $table->bigInteger('visitplanner_id')->unsigned();
            $table->tinyInteger('status');
            $table->string('place', 255);
            $table->string('district', 255)->nullable();
            $table->string('state', 255)->nullable();
            $table->string('progress', 255)->nullable();
            $table->string('entry_source', 255);
            $table->string('entry_source_type', 255);
            $table->bigInteger('entry_source_id')->unsigned();
            $table->text('additional_contacts');
            $table->text('additional_information');
            $table->date('visit_date')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_lead');
    }
};


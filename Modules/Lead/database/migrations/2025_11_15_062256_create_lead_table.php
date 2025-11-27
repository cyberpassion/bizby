<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cyp_lead', function (Blueprint $table) {

            // Common SaaS fields (id, client_id, status, created_by, updated_by, deleted_by, timestamps, soft deletes)
            $table->commonSaasFields();

            // Lead-specific fields
            $table->bigInteger('lead_id');

            $table->string('generated_by_type', 255);
            $table->string('generated_by', 255);

            $table->text('product');
            $table->text('product_info');

            $table->text('potential_client_name');
            $table->string('potential_client_contact_person', 255);

            $table->string('district', 255);
            $table->string('state', 255);

            $table->text('potential_client_address');
            $table->string('potential_client_pincode', 255);
            $table->string('potential_client_mobile_number', 255);
            $table->string('potential_client_email', 255);

            $table->string('contact_by_type', 255);
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

            $table->bigInteger('thread_parent');
            $table->bigInteger('visitplanner_id');

            $table->string('potential_client_website', 255)->nullable();
            $table->string('progress', 255)->nullable();

            $table->string('entry_source', 255);
            $table->string('entry_source_id', 255);

            $table->date('visit_date')->nullable();

            $table->string('category', 255)->nullable();
            $table->string('potential_client_place', 255)->nullable();
            $table->string('potential_client_state', 255)->nullable();

            $table->text('additional_contacts')->nullable();

            $table->bigInteger('generated_by_id')->nullable();
            $table->bigInteger('contact_by_id')->nullable();

            $table->string('place', 255)->nullable();

            $table->string('entry_source_type', 255)->nullable();

            $table->text('additional_information')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_lead');
    }
};

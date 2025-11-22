<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cyp_lead', function (Blueprint $table) {
            // Common SaaS fields
            $table->commonSaasFields();

            // Lead-specific fields
            $table->bigInteger('lead_id')->unsigned();
            $table->string('category', 255);
            $table->text('product')->nullable();
            $table->text('product_info')->nullable();
            $table->text('potential_client_name')->nullable();
            $table->string('potential_client_contact_person', 255)->nullable();
            $table->text('potential_client_address')->nullable();
            $table->string('potential_client_pincode', 255)->nullable();
            $table->string('potential_client_place', 255)->nullable();
            $table->string('potential_client_state', 255)->nullable();
            $table->string('potential_client_mobile_number', 255)->nullable();
            $table->string('potential_client_website', 255)->nullable();
            $table->string('potential_client_email', 255)->nullable();

            // Polymorphic generator and contact references
            $table->string('generated_by_type', 255)->nullable();
            $table->unsignedBigInteger('generated_by_id')->nullable();
            $table->string('contact_by_type', 255)->nullable();
            $table->unsignedBigInteger('contact_by_id')->nullable();

            $table->date('contact_date')->nullable();
            $table->string('contact_mode', 255)->nullable();
            $table->string('contact_reference_number', 255)->nullable();
            $table->text('contact_response')->nullable();
            $table->text('contact_remark')->nullable();
            $table->string('contact_after', 255)->nullable();
            $table->string('reference', 255)->nullable();
            $table->string('is_existing_client', 255)->nullable();
            $table->string('expectation', 255)->nullable();
            $table->date('next_date')->nullable();
            $table->unsignedBigInteger('thread_parent')->nullable();
            $table->unsignedBigInteger('visitplanner_id')->nullable();
            $table->string('place', 255)->nullable();
            $table->string('district', 255)->nullable();
            $table->string('state', 255)->nullable();
            $table->string('progress', 255)->nullable();
            $table->text('additional_contacts')->nullable();
            $table->text('additional_information')->nullable();
            $table->date('visit_date')->nullable();

            // Polymorphic entry source
            $table->string('entry_source_type', 255)->nullable();
            $table->unsignedBigInteger('entry_source_id')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_lead');
    }
};

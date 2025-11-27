<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cyp_contact', function (Blueprint $table) {

            // Common SaaS fields (ID, client_id, status, audit, soft deletes, timestamps)
            $table->commonSaasFields();

            // Contact-specific fields
            $table->string('phone_number', 255);
            $table->text('group_name');
            $table->bigInteger('group_name_id')->nullable();
            $table->text('name')->nullable();
            $table->string('email', 255)->nullable();
            $table->string('address', 255)->nullable();
            $table->bigInteger('contact_id')->nullable();
            $table->text('group_type')->nullable();
            $table->bigInteger('group_id')->nullable();
            $table->text('contact_name')->nullable();
            $table->string('designation', 255)->nullable();
            $table->text('permanent_address')->nullable();
            $table->text('additional_information')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_contact');
    }
};




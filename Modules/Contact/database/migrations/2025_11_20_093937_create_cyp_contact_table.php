<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cyp_contact', function (Blueprint $table) {
            // Common SaaS fields
            $table->commonSaasFields();

            // Contact-specific fields
            $table->string('phone_number', 255);
            $table->string('group', 255);
            $table->text('group_type')->nullable();
            $table->unsignedBigInteger('group_id')->nullable();
            $table->text('contact_name')->nullable();
            $table->string('email')->nullable();
            $table->string('designation', 255)->nullable();
            $table->text('address')->nullable();
            $table->text('additional_information')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cyp_contact');
    }
};


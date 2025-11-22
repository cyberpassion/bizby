<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cyp_signup', function (Blueprint $table) {
            // Common SaaS fields: id, client_id, status, timestamps, soft deletes, audit
            $table->commonSaasFields();

            // Signup-specific fields
            $table->unsignedBigInteger('form_id');
            $table->string('form_label', 255)->nullable();
            $table->string('signup_label', 255)->nullable();
            $table->string('submitted_by_type', 255)->nullable();
            $table->unsignedBigInteger('submitted_by_id')->nullable();
            $table->text('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_number', 255)->nullable();
            $table->text('signup_info')->nullable();
            $table->string('signup_fee', 255)->nullable();
            $table->string('entry_source', 255)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_signup');
    }
};


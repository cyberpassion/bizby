<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cyp_registration', function (Blueprint $table) {
            // Common SaaS fields: id, client_id, status, timestamps, soft deletes, audit
            $table->commonSaasFields();

            // Registration-specific fields
            $table->string('registration_type', 255);
            $table->string('session', 64)->nullable();
            $table->text('name');
            $table->text('phone_number')->nullable();
            $table->text('email_id')->nullable();
            $table->text('permanent_address')->nullable();
            $table->text('remark')->nullable();
            $table->text('metainfo')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_registration');
    }
};

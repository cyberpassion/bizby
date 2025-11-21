<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cyp_registration', function (Blueprint $table) {

            // Common fields for SaaS modules
            $table->commonSaasFields(); // id(), client_id, status, audit fields, softDeletes, timestamps

            // Common person-related fields
            $table->commonPersonFields(); // first_name, middle_name, last_name, dob, phone_number, email, address

            // Your table-specific fields
            $table->string('registration_type', 255)->nullable();
            $table->string('session', 64)->nullable();

            $table->text('remark')->nullable();
            $table->text('metainfo')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_registration');
    }
};

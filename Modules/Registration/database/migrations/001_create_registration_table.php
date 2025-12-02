<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cyp_registration', function (Blueprint $table) {

            // Common SaaS Fields
            $table->commonSaasFields();
            // id, client_id, status, created_by, updated_by, deleted_by, deleted_at, timestamps

            //  Module Specific Fields
            $table->bigIncrements('registration_id');

            $table->string('registration_type', 255);

			$table->string('session', 64)->nullable();

            // Patient/person info using macro
            $table->commonPersonFields();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_registration');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cyp_student', function (Blueprint $table) {

			// Common SaaS Fields
            $table->commonSaasFields();
            // id, client_id, status, created_by, updated_by, deleted_by, deleted_at, timestamps

            // Patient/person info using macro
            $table->commonPersonFields();

            $table->foreignId('class_id')->nullable(); // current class
            $table->string('academic_year'); // e.g. 2025-26

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_student');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {

			// Common SaaS Fields
            $table->commonSaasFields();
            // id, client_id, status, created_by, updated_by, deleted_by, deleted_at, timestamps

            // Patient/person info using macro
            $table->commonPersonFields();

			$table->string('admission_number')->nullable()->comment('Institute-specific admission or roll number');
            $table->date('admission_date')->nullable();

			// Parent/guardian info
            $table->string('father_name')->nullable()->comment('Name of the father');
            $table->string('mother_name')->nullable()->comment('Name of the mother');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};

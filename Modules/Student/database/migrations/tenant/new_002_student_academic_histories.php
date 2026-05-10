<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('student_academic_histories', function (Blueprint $table) {
		    // Common SaaS Fields
            $table->commonSaasFields();
            // id, client_id, status, created_by, updated_by, deleted_by, deleted_at, timestamps

		    $table->foreignId('student_id')->constrained()->cascadeOnDelete();
		    $table->foreignId('year_id')->constrained('student_academic_years')->cascadeOnDelete();

		    // These reference terms table
		    $table->foreignId('class_term_id')->constrained('terms');   // group = class
    		$table->foreignId('section_term_id')->constrained('terms'); // group = section

		    $table->boolean('is_current')->default(false);

		    $table->unique(['student_id', 'year_id', 'is_current'],'uniq_student_current_history');

		});
    }

    public function down(): void
    {
        Schema::dropIfExists('student_academic_histories');
    }
};

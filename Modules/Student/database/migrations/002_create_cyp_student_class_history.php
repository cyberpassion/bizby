<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('student_class_history', function (Blueprint $table) {
		    $table->id();

		    $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
    		//$table->foreignId('class_id')->constrained()->onDelete('cascade');

		    $table->string('academic_year');

		    $table->date('from_date')->nullable();
		    $table->date('to_date')->nullable();

		    $table->string('status')->default('active');
		    // active, completed, promoted, demoted, transferred

		    $table->string('reason')->nullable();

		    $table->timestamps();
		});

    }

    public function down(): void
    {
        Schema::dropIfExists('student_class_history');
    }
};

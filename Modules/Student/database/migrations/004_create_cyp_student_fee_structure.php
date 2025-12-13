<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_fee_structures', function (Blueprint $table) {

            $table->id();

            $table->foreignId('academic_level_id')
                ->constrained('academic_levels')
                ->onDelete('cascade');

            $table->foreignId('fee_head_id')
                ->constrained('student_fee_heads')
                ->onDelete('cascade');

            $table->string('academic_year'); // e.g. 2025-26

            $table->string('frequency'); 
            // monthly, quarterly, yearly, one_time
            // usually copied from student_fee_heads.frequency

            $table->decimal('amount', 10, 2)->default(0);

            $table->timestamps();

            // Prevent duplicate fee structure entries
            $table->unique(['academic_level_id', 'fee_head_id', 'academic_year'], 'unique_fee_structure');
			$table->index(['academic_level_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_fee_structures');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendance_session_batches', function (Blueprint $table) {

            $table->id();

            $table->foreignId('attendance_session_id')
                ->constrained('attendance_sessions')
                ->cascadeOnDelete();

            $table->foreignId('batch_id')
                ->constrained('attendance_batches')
                ->cascadeOnDelete();

            $table->unique([
                'attendance_session_id',
                'batch_id'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendance_session_batches');
    }
};
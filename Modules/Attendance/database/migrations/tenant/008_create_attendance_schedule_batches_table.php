<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendance_schedule_batches', function (Blueprint $table) {

		    $table->id();

		    $table->foreignId('attendance_schedule_id')
        		->constrained()
		        ->cascadeOnDelete();

		    $table->foreignId('batch_id')
        		->constrained('attendance_batches')
		        ->cascadeOnDelete();

		    $table->unique(
			    ['attendance_schedule_id', 'batch_id'],
			    'asb_schedule_batch_unique'
			);
		});
    }

    public function down(): void
    {
        Schema::dropIfExists('attendance_schedule_batches');
    }
};
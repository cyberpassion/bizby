<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendance_batch_participants', function (Blueprint $table) {

            $table->commonSaasFields();

            $table->foreignId('batch_id')
                ->constrained('attendance_batches')
                ->cascadeOnDelete();

            //$table->morphs('participant');
			$table->unsignedBigInteger('participant_id');
			$table->string('participant_type');

			$table->index(
    			['participant_type', 'participant_id'],
			    'abp_participant_idx'
			);

            $table->string('role')->nullable();

            $table->unique(
                ['batch_id', 'participant_id', 'participant_type'],
                'abp_batch_participant_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendance_batch_participants');
    }
};
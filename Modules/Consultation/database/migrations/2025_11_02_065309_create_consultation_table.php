<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Only create table if it doesn't exist
        if (!Schema::hasTable('cyp_consultation')) {
            Schema::create('cyp_consultation', function (Blueprint $table) {
                $table->id('consultation_id');              // Primary key
                $table->unsignedBigInteger('consultation_group_id')->nullable();
                $table->date('date')->nullable();
                $table->dateTime('datetime')->nullable()->nullable();
                $table->date('consultation_date')->nullable();
                $table->time('consultation_time')->nullable();
                $table->unsignedBigInteger('day_token_id')->nullable();
                $table->string('consultation_through', 255)->nullable();
                $table->unsignedBigInteger('consultation_with')->nullable();
                $table->text('consultation_for')->nullable();
                $table->text('consultation_for_detail')->nullable();
                $table->unsignedBigInteger('patient_id')->nullable();
                $table->string('patient_name', 255)->nullable();
                $table->string('guardian_type', 255)->nullable();
                $table->string('guardian_name', 255)->nullable();
                $table->string('father_name', 255)->nullable();
                $table->string('phone_number', 255)->nullable();
                $table->string('gender', 255)->nullable();
                $table->string('email', 255)->nullable();
                $table->tinyInteger('age')->nullable();
                $table->string('permanent_address', 255)->nullable();
                $table->string('aadhar_number', 255)->nullable();
                $table->string('consultation_type', 255)->nullable();
                $table->float('consultation_fee')->nullable();
                $table->float('consultation_extra_fee')->nullable();
                $table->string('referred_by', 255)->nullable();
                $table->string('referred_to', 255)->nullable();
                $table->text('remark')->nullable();
                $table->string('expected_next_consultation_after', 255)->nullable();
                $table->date('next_date')->nullable();
                $table->unsignedBigInteger('thread_parent')->nullable();
                $table->tinyInteger('status');
                $table->unsignedBigInteger('client_id')->nullable();
                $table->timestamps();  // created_at & updated_at
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};

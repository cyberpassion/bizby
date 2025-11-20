<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cyp_consultation', function (Blueprint $table) {
            $table->id('consultation_id');
            $table->unsignedBigInteger('consultation_group_id')->nullable();
            $table->date('date')->nullable();
            $table->dateTime('datetime')->nullable();
            $table->date('consultation_date')->nullable();
            $table->time('consultation_time')->nullable();
            $table->unsignedBigInteger('day_token_id')->nullable();
            $table->string('consultation_through')->nullable();
            $table->unsignedBigInteger('consultation_with')->nullable();
            $table->text('consultation_for')->nullable();
            $table->text('consultation_for_detail')->nullable();
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->string('patient_name')->nullable();
            $table->string('guardian_type')->nullable();
            $table->string('guardian_name')->nullable();
            $table->string('father_name')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('gender')->nullable();
            $table->string('email')->nullable();
            $table->unsignedTinyInteger('age')->nullable();
            $table->string('permanent_address')->nullable();
            $table->string('aadhar_number')->nullable();
            $table->string('consultation_type')->nullable();
            $table->decimal('consultation_fee', 10, 2)->nullable();
            $table->decimal('consultation_extra_fee', 10, 2)->nullable();
            $table->string('referred_by')->nullable();
            $table->string('referred_to')->nullable();
            $table->text('remark')->nullable();
            $table->string('expected_next_consultation_after')->nullable();
            $table->date('next_date')->nullable();
            $table->unsignedBigInteger('thread_parent')->nullable();
            $table->unsignedTinyInteger('status')->default(1);
            $table->unsignedBigInteger('client_id')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_consultation');
    }
};

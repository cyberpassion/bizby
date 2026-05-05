<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->commonSaasFields();

            $table->foreignId('user_id');
            $table->foreignId('registration_cycle_id')->constrained()->cascadeOnDelete();

            $table->string('current_step')->nullable();
            $table->string('registration_status')->default('draft');

            $table->timestamp('submitted_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('registration_steps', function (Blueprint $table) {
            $table->commonSaasFields();

            $table->foreignId('registration_id')->constrained()->cascadeOnDelete();
            $table->foreignId('registration_type_step_id')->constrained()->cascadeOnDelete();

            $table->json('data')->nullable(); // step form data
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registration_steps');
    }
};
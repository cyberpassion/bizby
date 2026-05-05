<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('registration_type_steps', function (Blueprint $table) {
            $table->commonSaasFields();

            $table->foreignId('registration_type_id')->constrained()->cascadeOnDelete();

            $table->string('step_key'); // basic_info, academic, documents
            $table->string('title'); // UI label
            $table->integer('step_order');
            $table->boolean('is_required')->default(true);

            $table->json('config')->nullable(); // form schema
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registration_type_steps');
    }
};
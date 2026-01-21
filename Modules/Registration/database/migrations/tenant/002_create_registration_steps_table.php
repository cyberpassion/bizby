<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('registration_steps', function (Blueprint $table) {
		    $table->id();
		    $table->foreignId('registration_id')->constrained()->cascadeOnDelete();

		    $table->string('step'); // profile, documents, payment
		    $table->boolean('is_completed')->default(false);

		    $table->json('data')->nullable(); // step form data

		    $table->timestamps();
		});
    }

    public function down(): void
    {
        Schema::dropIfExists('registration_steps');
    }
};
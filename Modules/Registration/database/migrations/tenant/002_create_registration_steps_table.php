<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('registration_steps', function (Blueprint $table) {
		    $table->commonSaasFields(); // includes id, tenant_id, timestamps, softDeletes
		    $table->foreignId('registration_id')->constrained()->cascadeOnDelete();

		    $table->string('step'); // basic, academic, documents, review, payment
			$table->integer('step_order')->nullable();
		    $table->boolean('is_completed')->default(false);

		    $table->json('data')->nullable(); // step form data
		});
    }

    public function down(): void
    {
        Schema::dropIfExists('registration_steps');
    }
};
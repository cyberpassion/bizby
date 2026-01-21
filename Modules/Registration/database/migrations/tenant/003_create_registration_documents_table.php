<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('registration_documents', function (Blueprint $table) {
		    $table->id();
		    $table->foreignId('registration_id')->constrained()->cascadeOnDelete();

		    $table->string('name');
		    $table->string('path');

		    $table->timestamp('verified_at')->nullable();
		    $table->timestamps();
		});
    }

    public function down(): void
    {
        Schema::dropIfExists('registration_documents');
    }
};
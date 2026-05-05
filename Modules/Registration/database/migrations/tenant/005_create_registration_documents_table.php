<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('registration_documents', function (Blueprint $table) {
		    $table->commonSaasFields(); // includes id, tenant_id, timestamps, softDeletes
		    $table->foreignId('registration_id')->constrained()->cascadeOnDelete();

		    $table->string('name')->nullable();
		    $table->string('path');
			$table->string('type')->nullable(); // aadhaar, marksheet, photo
			$table->integer('upload_id')->nullable();
			$table->foreignId('registration_type_document_id')->nullable();

		    $table->timestamp('verified_at')->nullable();
		});
    }

    public function down(): void
    {
        Schema::dropIfExists('registration_documents');
    }
};
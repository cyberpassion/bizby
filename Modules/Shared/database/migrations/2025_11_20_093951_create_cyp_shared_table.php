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
        Schema::create('cyp_upload', function (Blueprint $table) {
            // Common SaaS fields (id, client_id, status, timestamps, soft deletes, audit)
            $table->commonSaasFields();

			// The entity this upload belongs to (e.g., student, employee, customer)
            $table->unsignedBigInteger('reference_id');

            // The type/key of the document (e.g., profile_photo, resume, certificate)
            $table->string('file_key');

            // Add document_path column (nullable because file may not be uploaded initially)
            $table->string('document_path')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cyp_upload');  // FIXED: correct table name
    }
};

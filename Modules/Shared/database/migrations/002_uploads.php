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
        Schema::create('uploads', function (Blueprint $table) {
            // Common SaaS fields (id, client_id, status, timestamps, soft deletes, audit)
            $table->commonSaasFields();

			// The entity this upload belongs to (e.g., student, employee, customer)
			$table->string('reference_type', 255)->nullable();

			// The entity this upload belongs to (e.g., student, employee, customer)
            $table->unsignedBigInteger('reference_id')->nullable();

            // The type/key of the document (e.g., profile_photo, resume, certificate)
            $table->string('file_key');

            // Add document_path column (nullable because file may not be uploaded initially)
            $table->string('document_path')->nullable();

			$table->string('disk')->nullable();

			$table->unique(['reference_type', 'reference_id', 'file_key'],'uploads_unique_ref');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uploads');  // FIXED: correct table name
    }
};

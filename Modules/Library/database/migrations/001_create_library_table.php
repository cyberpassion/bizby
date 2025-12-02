<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cyp_library', function (Blueprint $table) {

            // SaaS Standard Fields (client_id, status, created_by, updated_by, deleted_by, softDeletes, timestamps)
            $table->commonSaasFields();

            // Library Item Fields
            $table->string('isbn')->nullable();
            $table->string('item_name');

            $table->longText('description')->nullable();

            $table->unsignedInteger('page_count')->nullable();

            $table->string('price')->nullable();

            $table->string('language')->nullable();
            $table->string('author_name')->nullable();
            $table->string('publication_name')->nullable();

            $table->string('publishing_year', 4)->nullable();
            $table->date('publishing_date')->nullable();

            $table->float('average_rating')->nullable();

            $table->string('category')->nullable();

            $table->unsignedBigInteger('total_quantity')->nullable();

            $table->string('is_currently_in_use', 8)->nullable();

            // Entity / Accession
            $table->string('entity_type')->nullable();
            $table->string('accession_number')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_library');
    }
};



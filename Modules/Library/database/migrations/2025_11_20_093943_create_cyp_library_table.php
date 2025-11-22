<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cyp_library', function (Blueprint $table) {
            // Common SaaS fields
            $table->commonSaasFields();

            // Library-specific fields
            $table->string('isbn', 255);
            $table->string('item_name', 255);
            $table->longText('description')->nullable();
            $table->unsignedTinyInteger('page_count')->nullable();
            $table->string('price', 255);
            $table->string('language', 255);
            $table->string('author_name', 255);
            $table->string('publication_name', 255);
            $table->string('publishing_year', 255);
            $table->date('publishing_date')->nullable();
            $table->float('average_rating')->nullable();
            $table->text('category')->nullable();
            $table->unsignedBigInteger('total_quantity')->nullable();
            $table->longText('remark')->nullable();
            $table->longText('additional_info')->nullable();
            $table->string('is_currently_in_use', 8);
            $table->string('entity_type', 255)->nullable();
            $table->string('accession_number', 255)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_library');
    }
};


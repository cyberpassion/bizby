<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('listings', function (Blueprint $table) {
            // Common SaaS fields
    		$table->commonSaasFields();

            /* ---------------- Basic Info ---------------- */
            $table->string('name');
            $table->string('owner_name')->nullable();

            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('website')->nullable();

            $table->unsignedBigInteger('category_id')->nullable();

            /* ---------------- Location ---------------- */
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('district')->nullable();
            $table->string('state')->nullable();
            $table->string('pincode', 10)->nullable();

            $table->string('map_link')->nullable();

            /* ---------------- Social ---------------- */
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('youtube')->nullable();
            $table->string('twitter')->nullable();
            $table->text('other_links')->nullable(); // JSON/string

            /* ---------------- Business Content ---------------- */
            $table->text('about')->nullable();
            $table->text('services')->nullable();
            $table->text('additional_info')->nullable();

            /* ---------------- Status & Flags ---------------- */
            $table->boolean('is_verified')->default(false);
            $table->boolean('is_featured')->default(false);

            $table->date('valid_till')->nullable();

            /* ---------------- Meta / SEO ---------------- */
            $table->string('slug')->unique()->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();

            /* ---------------- Indexes ---------------- */
            $table->index(['name']);
            $table->index(['phone']);
            $table->index(['category_id']);
            $table->index(['city', 'state']);
            $table->index(['is_verified']);
            $table->index(['is_featured']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
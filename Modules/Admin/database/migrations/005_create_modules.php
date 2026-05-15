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
        Schema::create('modules', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Identity
            |--------------------------------------------------------------------------
            */

            // Unique system key
            // Example: student, finance, hostel
            $table->string('key')->unique();

            // Human readable module name
            // Example: Student Management
            $table->string('name');

            // URL-friendly slug
            // Example: student-management
            $table->string('slug')->unique()->nullable();

            /*
            |--------------------------------------------------------------------------
            | Descriptions
            |--------------------------------------------------------------------------
            */

            // Small description for cards/listing
            $table->string('short_description')->nullable();

            // Full module description
            $table->text('description')->nullable();

            /*
            |--------------------------------------------------------------------------
            | UI / Branding
            |--------------------------------------------------------------------------
            */

            // Icon name or icon path
            // Example: users, wallet, bus
            $table->string('icon')->nullable();

            // Thumbnail image
            $table->string('thumbnail')->nullable();

            // Banner image
            $table->string('banner')->nullable();

            // Module category
            // Example: Academic, Finance, HR
            $table->string('category')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Module Data
            |--------------------------------------------------------------------------
            */

            // Module features list
            // Example:
            // [
            //   "Attendance",
            //   "Parent Portal",
            //   "Student Profiles"
            // ]
            $table->json('features')->nullable();

            // Dependencies on other modules
            // Example:
            // ["student", "finance"]
            $table->json('dependencies')->nullable();

            // Module permissions
            $table->json('permissions')->nullable();

            // Module version
            $table->string('version')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Pricing
            |--------------------------------------------------------------------------
            */

            // Base module price
            $table->decimal('price', 10, 2)->nullable();

            // Whether module is billable
            $table->boolean('is_billable')->default(true);

            /*
            |--------------------------------------------------------------------------
            | System Flags
            |--------------------------------------------------------------------------
            */

            // Core modules cannot be removed
            $table->boolean('is_core')->default(false);

            // Module available for assignment
            $table->boolean('is_active')->default(true);

            // Show module in marketplace/listing page
            $table->boolean('is_visible')->default(true);

            /*
            |--------------------------------------------------------------------------
            | Sorting
            |--------------------------------------------------------------------------
            */

            // Display ordering
            $table->integer('sort_order')->default(0);

            /*
            |--------------------------------------------------------------------------
            | Timestamps
            |--------------------------------------------------------------------------
            */

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modules');
    }
};
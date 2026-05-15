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
        Schema::create('addons', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Identity
            |--------------------------------------------------------------------------
            */

            // Unique addon key
            // Example: sms, whatsapp, analytics
            $table->string('key')->unique();

            // Human readable addon name
            $table->string('name');

            // URL friendly slug
            $table->string('slug')->unique()->nullable();

            /*
            |--------------------------------------------------------------------------
            | Descriptions
            |--------------------------------------------------------------------------
            */

            // Short description for cards/listings
            $table->string('short_description')->nullable();

            // Full addon description
            $table->text('description')->nullable();

            /*
            |--------------------------------------------------------------------------
            | UI / Branding
            |--------------------------------------------------------------------------
            */

            // Icon name or icon path
            // Example: mail, bot, database
            $table->string('icon')->nullable();

            // Thumbnail image
            $table->string('thumbnail')->nullable();

            // Banner image
            $table->string('banner')->nullable();

            // Addon category
            // Example: Communication, Security
            $table->string('category')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Addon Data
            |--------------------------------------------------------------------------
            */

            // Addon features
            $table->json('features')->nullable();

            // Addon version
            $table->string('version')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Pricing
            |--------------------------------------------------------------------------
            */

            // Addon price
            $table->decimal('price', 10, 2)->nullable();

            // Billing cycle
            // monthly / yearly / lifetime
            $table->string('billing_cycle')->default('monthly');

            // Whether addon is billable
            $table->boolean('is_billable')->default(true);

            /*
            |--------------------------------------------------------------------------
            | System Flags
            |--------------------------------------------------------------------------
            */

            // Whether addon is active
            $table->boolean('is_active')->default(true);

            // Show addon in marketplace/listing
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
        Schema::dropIfExists('addons');
    }
};
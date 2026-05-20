<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('listing_page_blocks', function (Blueprint $table) {

            $table->id();

            /* -------------------------------------------------
            | RELATIONS
            |-------------------------------------------------- */

            $table->foreignId('listing_id')
                ->constrained()
                ->cascadeOnDelete();

            /* -------------------------------------------------
            | BLOCK INFO
            |-------------------------------------------------- */

            $table->string('type');
            /*
                hero
                image_left_content_right
                content_left_image_right
                gallery
                faq
                stats
                features
                testimonials
                map
                video
                cta
            */

            $table->string('menu_title')->nullable();

            $table->string('slug')->nullable();

            /* -------------------------------------------------
            | COMMON CONTENT
            |-------------------------------------------------- */

            $table->string('title')->nullable();

            $table->string('subtitle')->nullable();

            $table->longText('content')->nullable();

            /* -------------------------------------------------
            | MEDIA
            |-------------------------------------------------- */

            $table->string('image')->nullable();

            $table->string('image_2')->nullable();

            $table->json('gallery')->nullable();

            $table->string('video_url')->nullable();

            /* -------------------------------------------------
            | CTA
            |-------------------------------------------------- */

            $table->string('button_text')->nullable();

            $table->string('button_link')->nullable();

            /* -------------------------------------------------
            | DESIGN
            |-------------------------------------------------- */

            $table->string('background_color')->nullable();

            $table->string('text_color')->nullable();

            $table->string('layout')->nullable();

            $table->string('alignment')->nullable();

            /* -------------------------------------------------
            | FLEXIBLE JSON
            |-------------------------------------------------- */

            $table->json('extra_data')->nullable();

            /*
                faq items
                cards
                features
                testimonials
                stats
                maps
                dynamic configs
                etc
            */

            /* -------------------------------------------------
            | UI CONTROL
            |-------------------------------------------------- */

            $table->integer('sort_order')->default(0);

            $table->boolean('is_active')->default(true);

            /* -------------------------------------------------
            | SEO
            |-------------------------------------------------- */

            $table->string('seo_title')->nullable();

            $table->text('seo_description')->nullable();

            /* -------------------------------------------------
            | TIMESTAMPS
            |-------------------------------------------------- */

            $table->timestamps();

            /* -------------------------------------------------
            | INDEXES
            |-------------------------------------------------- */

            $table->index(['listing_id']);

            $table->index(['type']);

            $table->index(['sort_order']);

            $table->index(['is_active']);

            $table->unique(['listing_id', 'menu_title']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('listing_page_blocks');
    }
};

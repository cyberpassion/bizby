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

            /* ---------------- Relations ---------------- */
            $table->foreignId('listing_id')
                ->constrained()
                ->cascadeOnDelete();

            /* ---------------- Block Info ---------------- */
            $table->string('type'); 
            // hero
            // image_left_content_right
            // content_left_image_right
            // gallery
            // faq
            // cta
            // etc

            $table->string('menu_title');
			$table->string('title')->nullable();
            $table->string('subtitle')->nullable();

            $table->longText('content')->nullable();

            /* ---------------- Media ---------------- */
            $table->string('image')->nullable();
            $table->string('image_2')->nullable();
            $table->json('gallery')->nullable();

            $table->string('video_url')->nullable();

            /* ---------------- CTA ---------------- */
            $table->string('button_text')->nullable();
            $table->string('button_link')->nullable();

            /* ---------------- Extra Flexible Data ---------------- */
            $table->json('extra_data')->nullable();

            /*
                examples:
                faq items
                stats
                cards
                features
                colors
                alignment
                etc
            */

            /* ---------------- UI ---------------- */
            $table->integer('sort_order')->default(0);

            $table->boolean('is_active')->default(true);

            /* ---------------- Styling ---------------- */
            $table->string('background_color')->nullable();
            $table->string('text_color')->nullable();

            /* ---------------- Timestamps ---------------- */
            $table->timestamps();

            /* ---------------- Indexes ---------------- */
            $table->index(['listing_id']);
            $table->index(['type']);
            $table->index(['sort_order']);
            $table->index(['is_active']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('listing_page_blocks');
    }
};
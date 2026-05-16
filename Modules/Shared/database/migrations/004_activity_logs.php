<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activity_logs', function (Blueprint $table) {

            $table->commonSaasFields();

            /*
            |--------------------------------------------------------------------------
            | WHO DID IT
            |--------------------------------------------------------------------------
            */

            $table->nullableMorphs('causer');

            /*
            |--------------------------------------------------------------------------
            | WHAT WAS AFFECTED
            |--------------------------------------------------------------------------
            */

            $table->nullableMorphs('subject');

            /*
            |--------------------------------------------------------------------------
            | EVENT
            |--------------------------------------------------------------------------
            */

            $table->string('event');

            /*
            |--------------------------------------------------------------------------
            | DESCRIPTION
            |--------------------------------------------------------------------------
            */

            $table->text('description')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | CHANGE TRACKING
            |--------------------------------------------------------------------------
            */

            $table->json('old_values')
                ->nullable();

            $table->json('new_values')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | REQUEST INFO
            |--------------------------------------------------------------------------
            */

            $table->ipAddress('ip_address')
                ->nullable();

            $table->text('user_agent')
                ->nullable();

            $table->string('method', 10)
                ->nullable();

            $table->text('url')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | INDEXES
            |--------------------------------------------------------------------------
            */

            $table->index(['event']);

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
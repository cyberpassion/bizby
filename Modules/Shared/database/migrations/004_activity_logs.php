<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            // Common SaaS fields (id, client_id, status, timestamps, soft deletes, audit)
            $table->commonSaasFields();

            $table->string('stimulus');
            $table->string('module')->nullable();
            $table->string('activity');
            $table->string('operation');

            // renamed from `key` (reserved word)
            $table->string('entity_key');

            // JSON payload
            $table->json('summary')->nullable();

            $table->unsignedBigInteger('user_id');

            /* ================= Indexes ================= */
            $table->index('user_id');
            $table->index('module');
            $table->index('activity');
            $table->index('created_at');

            /* ============ Optional Foreign Keys ============
             Uncomment if you want referential integrity
             (avoid if logs must survive deletions)
            */
            // $table->foreign('user_id')->references('id')->on('users');
            // $table->foreign('client_id')->references('id')->on('clients');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};

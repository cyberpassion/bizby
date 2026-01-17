<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('scheduled_jobs', function (Blueprint $table) {
            $table->id();

            // Registry key (admin.SendTenantUpcomingRenewals)
            $table->string('key')->unique();

            // Ownership
            $table->string('module')->index();
            $table->string('job_class');

            // UI metadata
            $table->string('description')->nullable();

            // Defaults from config
            $table->json('default_config')->nullable();

            // Allowed user options
            $table->json('allowed_frequencies')->nullable();

            // User settings
            $table->string('frequency')->nullable(); // daily, weekly, cron
            $table->time('time')->nullable();
            $table->json('days')->nullable(); // weekly
            $table->string('cron')->nullable(); // cron expression

            // State
            $table->boolean('is_active')->default(true);
            $table->boolean('is_enabled')->default(true);

            // Execution tracking
            $table->timestamp('last_run_at')->nullable();
            $table->timestamp('next_run_at')->nullable();

            // Safety
            $table->string('timezone')->default('UTC');
            $table->string('queue')->default('default');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scheduled_jobs');
    }
};

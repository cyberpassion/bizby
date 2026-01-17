<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('schedule_job_registry', function (Blueprint $table) {
            $table->id();

            // Registry key (admin.SendTenantUpcomingRenewals)
            $table->string('key')->unique();

            // Module ownership
            $table->string('module')->index();

            // Job class
            $table->string('job_class');

            // UI metadata
            $table->string('description')->nullable();

            // Defaults from config
            $table->json('default_config')->nullable();
            // { frequency: daily, time: 09:00 }

            // Allowed user options
            $table->json('allowed_frequencies')->nullable();

            // System flags
            $table->boolean('is_active')->default(true);
            // false if module removed

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('schedule_job_registry');
    }
};

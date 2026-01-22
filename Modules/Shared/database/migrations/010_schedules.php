<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
       Schema::create('schedules', function (Blueprint $table) {
		    $table->id();

		    // Tenant ownership
		    $table->unsignedBigInteger('tenant_id');
    		$table->index('tenant_id');

		    // Human readable
		    $table->string('name'); 
    		// e.g. "Daily Fee Reminder"

		    // What job to run
		    $table->string('job_key');
    		// e.g. report:cash | reminder:fees | billing:invoice

		    // Scheduling
		    $table->string('frequency');
    		// daily | weekly | monthly | cron

		    $table->string('cron_expression')->nullable();
		    // used only when frequency = cron

		    $table->time('run_at')->nullable();
		    // 09:00 (used for daily/weekly/monthly)

		    $table->string('timezone')->default('Asia/Kolkata');

		    // Status
    		$table->boolean('is_active')->default(true);

		    // Tracking
		    $table->timestamp('last_run_at')->nullable();
		    $table->timestamp('next_run_at')->nullable();

		    // Extra config (optional)
		    $table->json('meta')->nullable();
		    // e.g. { "days": ["mon","fri"], "emails": true }

		    $table->timestamps();
		});

    }

    public function down(): void
    {
        Schema::dropIfExists('tenant_schedules');
    }
};

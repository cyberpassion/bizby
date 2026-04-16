<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendance_calendar_days', function (Blueprint $table) {
		    $table->commonSaasFields();

		    $table->date('date');

		    $table->string('day_type')->default('working');
		    /*
        		working
		        holiday
        		weekend
		        blackout
        		special_working
		    */

		    $table->string('reason')->nullable();

		    $table->string('context')->nullable();

		    $table->unique(['date', 'context']);
		    $table->index(['tenant_id', 'date']);
		});

    }

    public function down(): void
    {
        Schema::dropIfExists('attendance_calendar_days');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendance_weekly_offs', function (Blueprint $table) {
		    $table->commonSaasFields();

		    $table->unsignedTinyInteger('weekday'); 
		    // 1 = Monday … 7 = Sunday

		    $table->string('context')->default('');

		    $table->unique(['tenant_id', 'weekday', 'context']);
		});

    }

    public function down(): void
    {
        Schema::dropIfExists('attendance_weekly_offs');
    }
};

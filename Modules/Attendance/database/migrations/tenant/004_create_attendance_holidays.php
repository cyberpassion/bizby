<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendance_holidays', function (Blueprint $table) {
		    $table->commonSaasFields();

		    $table->date('date');
		    $table->string('name');

		    $table->string('context')->default('');

		    $table->unique(['tenant_id', 'date', 'context']);
		});

    }

    public function down(): void
    {
        Schema::dropIfExists('attendance_holidays');
    }
};

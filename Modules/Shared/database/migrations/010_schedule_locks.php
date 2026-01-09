<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
       Schema::create('schedule_locks', function (Blueprint $table) {
		    $table->id();

		    $table->unsignedBigInteger('schedule_id');
		    $table->unsignedBigInteger('tenant_id');

		    $table->timestamp('locked_until');

		    $table->timestamps();

		    $table->unique(['schedule_id', 'tenant_id']);
		});

    }

    public function down(): void
    {
        Schema::dropIfExists('schedule_locks');
    }
};

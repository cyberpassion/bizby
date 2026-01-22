<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
       Schema::create('schedule_runs', function (Blueprint $table) {
		    $table->id();

		    $table->unsignedBigInteger('schedule_id');
		    $table->unsignedBigInteger('tenant_id');

		    $table->string('status');
		    // pending | running | success | failed

		    $table->timestamp('started_at')->nullable();
		    $table->timestamp('finished_at')->nullable();

		    $table->text('error')->nullable();

		    $table->timestamps();

		    $table->index(['schedule_id', 'tenant_id']);
		});

    }

    public function down(): void
    {
        Schema::dropIfExists('schedule_runs');
    }
};

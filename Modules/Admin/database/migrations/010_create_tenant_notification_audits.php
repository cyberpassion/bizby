<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tenant_notification_audits', function ($table) {
		    $table->id();
		    $table->unsignedBigInteger('tenant_id');
		    $table->string('activity_key');
    		$table->string('channel');
		    $table->string('to');
		    $table->string('status'); // queued | sent | failed
    		$table->json('payload')->nullable();
    		$table->text('error')->nullable();
    		$table->timestamps();
		});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenant_notification_audits');
    }
};

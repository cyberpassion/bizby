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
        Schema::create('tenant_installations', function (Blueprint $table) {
		    $table->id();
		    $table->uuid('uuid')->unique();

		    $table->unsignedBigInteger('tenant_id');

		    // Generic target
		    $table->string('target_type'); // tenant, module, addon, plan, feature
    		$table->unsignedBigInteger('target_id')->nullable();
		    $table->string('target_key')->nullable();

		    // Operation
		    $table->string('operation'); // provision, install, enable, disable, upgrade, remove

		    // Status tracking
    		$table->enum('status', ['pending','running','completed','failed','cancelled'])
          		->default('pending');

		    $table->string('step')->nullable();
		    $table->unsignedTinyInteger('progress')->default(0);

		    // Retry & debugging
		    $table->unsignedInteger('attempts')->default(0);
		    $table->text('last_error')->nullable();
		    $table->json('logs')->nullable();

		    // Meta
		    $table->json('config')->nullable();
    		$table->string('initiated_by')->nullable();

		    $table->timestamp('started_at')->nullable();
		    $table->timestamp('finished_at')->nullable();
    		$table->timestamps();

		    $table->index(['tenant_id', 'status']);
    		$table->index(['target_type', 'target_id']);
		    $table->index(['operation', 'status']);
		});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenant_installations');
    }
};

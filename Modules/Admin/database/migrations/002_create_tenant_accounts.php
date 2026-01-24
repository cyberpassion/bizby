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
        Schema::create('tenant_accounts', function (Blueprint $table) {
		    $table->id();

		    // Basic Info
		    $table->string('name')->nullable();
		    $table->string('domain')->nullable();
		    $table->string('email')->nullable()->unique();
    		$table->string('phone')->nullable()->unique();

		    // SaaS / Billing
		    $table->string('plan')->nullable();
    		$table->date('valid_till')->nullable();

		    // API Key (HASHED)
		    $table->string('api_key_hash', 64)->unique()->nullable();
    		$table->timestamp('api_key_last_used_at')->nullable();

		    // Lifecycle Status
		    $table->string('status')->default('draft')->index();
    		// draft | payment_pending | trial | active | suspended | cancelled

			$table->date('grace_till')->nullable();

		    // Optional settings
		    $table->json('settings')->nullable();

		    $table->timestamps();
    		$table->softDeletes();
		});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenant_accounts');
    }
};

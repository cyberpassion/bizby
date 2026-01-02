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
        Schema::create('tenants', function (Blueprint $table) {
		    $table->id();

		    // Basic Info
		    $table->string('name');
		    $table->string('domain')->nullable();
		    $table->string('email')->nullable();
    		$table->string('phone')->nullable();

		    // SaaS / Billing
		    $table->string('plan')->nullable();
    		$table->date('valid_till')->nullable();

		    // Tenant DB (future-proof)
		    $table->string('db_name')->nullable()->unique();
		    $table->string('db_host')->nullable();
		    $table->string('db_username')->nullable();
		    $table->text('db_password')->nullable(); // encrypt later

		    // API Key (HASHED)
		    $table->string('api_key_hash', 64)->unique()->nullable();
    		$table->timestamp('api_key_last_used_at')->nullable();

		    // Status
		    $table->boolean('is_active')->default(true);

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
        Schema::dropIfExists('tenants');
    }
};

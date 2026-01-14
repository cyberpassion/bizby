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
       Schema::create('tenant_users', function (Blueprint $table) {
		    $table->id();

		    // 🔗 Tenant reference (central DB)
		    $table->unsignedBigInteger('tenant_id');
		    $table->foreign('tenant_id')
        		->references('id')
        		->on('tenant_accounts')
        		->cascadeOnDelete();

		    // 🔗 Global user reference
		    $table->unsignedBigInteger('user_id');
		    $table->foreign('user_id')
        		->references('id')
				->on('users')
				->cascadeOnDelete();

		    // Role inside tenant
		    $table->string('role')->nullable();
    		// superadmin, principal, hod, accounts, clerk, operator, student

		    // Status
    		$table->boolean('is_active')->default(true);

	    	// Optional tenant-specific settings
   			$table->json('meta')->nullable();

		    $table->timestamps();
		    $table->softDeletes();

		    // 🚨 Important constraints
    		$table->unique(['tenant_id', 'user_id']); // one role per tenant
		});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenant_users');
    }
};

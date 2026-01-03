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
        Schema::create('installations', function (Blueprint $table) {
		    $table->id();

		    // Link to Tenant
		    $table->unsignedBigInteger('tenant_id');
    		$table->foreign('tenant_id')->references('id')->on('tenant_accounts')->onDelete('cascade');

		    // Optional: Link to Module (if this installation is module-specific)
		    $table->unsignedBigInteger('module_id')->nullable(); // FK to tenant_modules
    		$table->string('module_key')->nullable();            // e.g. 'finance', 'hostel'

		    // Version & Build
		    $table->string('app_version')->default('1.0.0');
    		$table->string('build_number')->nullable();

		    // Installation Information
		    $table->enum('status', [
        		'pending',
        		'installing',
        		'installed',
        		'failed',
        		'uninstalled'
    		])->default('pending');

	    	$table->string('step')->nullable();      // current step (db_migrate, module_setup, admin_create)
    		$table->integer('progress')->default(0); // % complete

		    // Tech Info
	    	$table->string('php_version')->nullable();
    		$table->string('server_ip')->nullable();
		    $table->string('installed_by')->nullable(); // admin username or user_id
		    $table->string('install_type')->default('saas'); // saas, single, self-hosted

		    // Installation Data (JSON)
		    $table->json('modules')->nullable();   // for logging multiple modules if needed
		    $table->json('config')->nullable();    // any custom config for tenant
    		$table->json('logs')->nullable();      // errors, warnings

		    // Timestamps
		    $table->timestamp('started_at')->nullable();
    		$table->timestamp('finished_at')->nullable();

		    $table->timestamps();
		});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('installations');
    }
};

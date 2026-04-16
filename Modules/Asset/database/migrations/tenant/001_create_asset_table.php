<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('assets', function (Blueprint $table) {
		    // Common SaaS fields (id, tenant_id, status, timestamps, soft deletes, audit)
            $table->commonSaasFields();

		    // Basic Info
		    $table->string('asset_code')->unique(); // AST-001 etc
		    $table->string('name');
    		$table->string('type')->index(); // Truck, Equipment, Gear

		    // Identification
		    // $table->string('unique_id')->unique(); // QR / Barcode
		    $table->string('serial_number')->nullable();

		    // Purchase Info
		    $table->date('purchase_date')->nullable();
		    $table->decimal('purchase_cost', 12, 2)->nullable();
    		$table->string('vendor')->nullable();

		    // Assignment
		    $table->unsignedBigInteger('center_id')->nullable()->index();
    		$table->unsignedBigInteger('assigned_to')->nullable()->index(); // user/employee

		    // Status
		    /*$table->enum('status', ['active', 'repair', 'not_working', 'disposed'])
        	  	->default('active')
          		->index();*/

		    // Asset
		    $table->date('last_service_date')->nullable();
    		$table->date('next_service_date')->nullable();

		    // Lifecycle
		    $table->date('warranty_expiry')->nullable();
    		$table->integer('useful_life_months')->nullable();

		    // Extra
		    $table->text('notes')->nullable();
		});
    }

    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};

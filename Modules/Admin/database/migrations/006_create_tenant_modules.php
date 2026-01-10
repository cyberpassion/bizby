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
        Schema::create('tenant_modules', function (Blueprint $table) {
		    $table->id();

		    $table->unsignedBigInteger('tenant_id');
		    $table->foreign('tenant_id')->references('id')->on('tenant_accounts')->onDelete('cascade');

			$table->unsignedBigInteger('module_id')->nullable();

			$table->foreign('module_id')->references('id')->on('modules')->nullOnDelete();

		    $table->string('module_key'); // e.g. "finance", "student", "hostel", "library"
		    $table->string('module_name'); // readable name if needed

		    // Date when module was added
		    $table->timestamp('activated_at')->nullable();

		    // If module was disabled later
    		$table->timestamp('deactivated_at')->nullable();

		    // Billing fields (optional)
		    $table->boolean('is_paid')->default(false);
		    $table->decimal('price', 10, 2)->nullable();
		    $table->date('valid_till')->nullable(); // if subscription based

		    // Module-specific config
    		$table->json('config')->nullable();

			// Status
    		$table->boolean('is_active')->default(true);

		    $table->timestamps();
		});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenant_modules');
    }
};

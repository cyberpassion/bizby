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
        Schema::create('tenant_addons', function (Blueprint $table) {
		    $table->id();

		    $table->unsignedBigInteger('tenant_id');
		    $table->foreign('tenant_id')->references('id')->on('tenant_accounts')->cascadeOnDelete();

		    $table->unsignedBigInteger('addon_id')->nullable();
		    $table->foreign('addon_id')->references('id')->on('addons')->nullOnDelete();

		    $table->string('addon_key');
		    $table->string('addon_name');

		    $table->timestamp('activated_at')->nullable();
		    $table->timestamp('deactivated_at')->nullable();

		    // Billing snapshot
		    $table->decimal('price', 10, 2)->nullable();
		    $table->date('valid_till')->nullable();

	    	$table->boolean('is_active')->default(true);

 		   $table->timestamps();
		});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenant_addons');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('inventory_adjustments', function (Blueprint $table) {
		    // Common SaaS fields (id, tenant_id, status, timestamps, soft deletes, audit)
            $table->commonSaasFields();

		    $table->unsignedBigInteger('inventory_item_id')->index();

		    $table->decimal('old_quantity', 14, 2);
		    $table->decimal('new_quantity', 14, 2);

		    $table->text('reason')->nullable();
		});
    }

    public function down(): void
    {
        Schema::dropIfExists('inventory_adjustments');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cyp_student_fee_head', function (Blueprint $table) {

			// Common SaaS Fields
            $table->commonSaasFields();
            // id, client_id, status, created_by, updated_by, deleted_by, deleted_at, timestamps

    	    $table->string('name');
        	$table->string('frequency'); // monthly / yearly / one_time / custom
        	$table->decimal('default_amount', 10, 2)->default(0);

    	});
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_fee_head');
    }
};

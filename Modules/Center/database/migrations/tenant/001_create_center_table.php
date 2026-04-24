<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('centers', function (Blueprint $table) {
            // Common SaaS fields (id, tenant_id, status, timestamps, soft deletes, audit)
            $table->commonSaasFields();
            $table->string('code')->unique(); // CTR-001
            $table->string('name');
	    	$table->string('state')->nullable();
			$table->string('place')->nullable();
            $table->text('location');
            $table->string('contact');
            $table->integer('capacity')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('centers');
    }
};
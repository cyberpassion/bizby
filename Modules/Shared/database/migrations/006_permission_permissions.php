<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('permission_permissions', function (Blueprint $table) {
	    	$table->id();

		    $table->string('module');
		    $table->string('operation');
    		$table->string('slug')->unique();

		    $table->timestamps();

    		$table->index(['module', 'operation']);
		});
    }

    public function down(): void
    {
        Schema::dropIfExists('permission_permissions');
    }
};

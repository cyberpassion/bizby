<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('permission_user_roles', function (Blueprint $table) {
		    $table->id();

		    $table->unsignedBigInteger('user_id');
		    $table->unsignedBigInteger('role_id');

		    $table->timestamps();

		    $table->unique(['user_id', 'role_id'], 'pur_user_role_unique');

		    $table->foreign('role_id')
        		->references('id')
		        ->on('permission_roles')
        		->cascadeOnDelete();
		});
    }

    public function down(): void
    {
        Schema::dropIfExists('permission_user_roles');
    }
};

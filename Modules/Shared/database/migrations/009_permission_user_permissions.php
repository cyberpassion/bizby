<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('permission_user_permissions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('permission_id');
            $table->unsignedBigInteger('tenant_id');

            $table->string('scope')->nullable();

            $table->timestamps();

            // 👇 MANUAL index name (FIX)
            $table->unique(
                ['user_id', 'permission_id', 'tenant_id'],
                'pup_user_perm_tenant_unique'
            );

            $table->foreign('permission_id')
                ->references('id')
                ->on('permission_permissions')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('permission_user_permissions');
    }
};

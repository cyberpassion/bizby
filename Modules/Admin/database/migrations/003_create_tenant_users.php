<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tenant_users', function (Blueprint $table) {
            $table->id();

            // 🔗 Tenant reference (central DB)
            $table->unsignedBigInteger('tenant_id');
            $table->foreign('tenant_id')
                ->references('id')
                ->on('tenant_accounts')
                ->cascadeOnDelete();

            // 🔗 Global user reference
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();

            // ✅ Correct role reference (RBAC)
            $table->unsignedBigInteger('role_id');

            // Status
            $table->boolean('is_active')->default(true);
			$table->boolean('tfa_enabled')->default(false);

            // Optional tenant-specific settings
            $table->json('meta')->nullable();

            $table->timestamps();
            $table->softDeletes();

			$table->index('role_id');

			$table->string('type')->default('portal');

            // 🚨 One user per tenant
            $table->unique(['tenant_id', 'user_id'], 'tenant_user_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tenant_users');
    }
};

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

            // Core
            $table->string('module');                  // users, orders, invoices
            $table->string('operation');               // view, create, update, delete
            $table->string('slug')->unique();          // users.view, users.update.own

            // SaaS power features
            $table->string('scope')->default('global'); // global, own, team, tenant
            $table->string('guard')->default('web');   // web, api, admin
            $table->unsignedBigInteger('parent_id')->nullable();

            $table->timestamps();

            $table->index(['module', 'operation']);
            $table->index(['parent_id']);

            $table->foreign('parent_id')
                ->references('id')
                ->on('permission_permissions')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('permission_permissions');
    }
};

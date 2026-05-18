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
            $table->string('surface');					// admin/portal/docs
            $table->string('category');					// module, addon, features etc
            $table->string('resource');					// module name, addon name, feature name etc
            $table->string('subresource')->nullable();	// optional finer control, e.g. specific module sub-section
            $table->string('operation');				// view, create, update, delete
            $table->string('slug')->unique();			// users.view, users.update.own
            $table->string('description')->nullable();

            // SaaS power features
            $table->string('scope')->default('global'); // global, own, team, tenant
            $table->string('guard')->default('web');   // web, api, admin
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->boolean('is_assignable')->default(true);
            $table->boolean('is_system')->default(false);

            $table->timestamps();

            $table->index(['resource', 'operation']);
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

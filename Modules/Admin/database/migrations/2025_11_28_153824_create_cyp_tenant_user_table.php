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
        Schema::create('cyp_tenant_user', function (Blueprint $table) {
            $table->id();

            // Relation to main tenant
            $table->unsignedBigInteger('tenant_id');
            $table->foreign('tenant_id')->references('id')->on('cyp_tenants')->onDelete('cascade');

            // User info
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();

            // Auth-related fields
            $table->string('password');
            $table->rememberToken();

            // Role inside tenant
            $table->string('role')->default('staff'); 
            // examples: superadmin, principal, hod, accounts, clerk, operator

            // Status
            $table->boolean('is_active')->default(true);

            // Extra settings if needed
            $table->json('meta')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cyp_tenant_user');
    }
};

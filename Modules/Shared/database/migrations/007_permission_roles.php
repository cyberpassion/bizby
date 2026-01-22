<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('permission_roles', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->unsignedBigInteger('tenant_id'); // SaaS tenant scope

            // optional but recommended
            $table->string('guard')->default('web');

            $table->timestamps();

            $table->unique(['name', 'tenant_id']);
            $table->index('tenant_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('permission_roles');
    }
};

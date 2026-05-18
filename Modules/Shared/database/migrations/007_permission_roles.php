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
            $table->string('slug');
            $table->string('description')->nullable();

            // optional but recommended
            $table->string('guard')->default('web');

            $table->string('surface')->nullable();
            $table->tinyInteger('priority')->default(0); // for sorting roles in UI, higher means more important
            $table->json('meta')->nullable();

            $table->timestamps();

            $table->boolean('is_system')->default(false);
            $table->unique('slug');
            $table->index('surface');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('permission_roles');
    }
};

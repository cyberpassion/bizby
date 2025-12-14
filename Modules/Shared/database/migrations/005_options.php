<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('options', function (Blueprint $table) {
            // Common SaaS fields (id, client_id, status, timestamps, soft deletes, audit)
            $table->commonSaasFields();

            $table->longText('option_name')->nullable();
            $table->longText('option_value')->nullable();

            $table->string('autoload');

            /* ============== Indexes (Recommended) ============== */
            $table->index('autoload');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('options');
    }
};

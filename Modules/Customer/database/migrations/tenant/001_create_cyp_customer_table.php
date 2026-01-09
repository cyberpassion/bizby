<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {

            // Common SaaS Fields
            $table->commonSaasFields();
            // id, client_id, status, created_by, updated_by, deleted_by, deleted_at, timestamps

            $table->string('business_type', 255)->nullable();
            $table->string('customer_type', 255)->nullable();

            // Patient/person info using macro
            $table->commonPersonFields();

            $table->text('reference')->nullable();

            $table->date('next_date');

            $table->string('state', 64)->nullable();
            $table->string('gstin', 255)->nullable();
            $table->string('district', 255)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
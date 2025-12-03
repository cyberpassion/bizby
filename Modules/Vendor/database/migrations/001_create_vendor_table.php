<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cyp_vendor', function (Blueprint $table) {

            // Common SaaS Fields
            $table->commonSaasFields();
            // id, client_id, status, created_by, updated_by, deleted_by, deleted_at, timestamps

			$table->string('vendor_type', 64)->nullable();
            $table->string('vendor_code', 255)->nullable();

            $table->unsignedBigInteger('vendor_parent_id')->nullable();

			// Patient/person info using macro
            $table->commonPersonFields();

            $table->string('vendor_gstin', 255)->nullable();
            $table->string('vendor_pan', 255)->nullable();

            $table->text('vendor_info')->nullable();
            $table->text('vendor_bank_info')->nullable();
            $table->text('vendor_terms_and_condition')->nullable();
            $table->text('region')->nullable();
            $table->text('vendor_person')->nullable();
            $table->text('vendor_person_designation')->nullable();
            $table->text('vendor_person_phone')->nullable();
            $table->text('vendor_person_email')->nullable();

            $table->string('state', 64)->nullable();
            $table->string('district', 255)->nullable();
            $table->text('sales')->nullable();
            $table->bigInteger('thread_parent')->nullable();

            $table->float('incentive_percentage')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_vendor');
    }
};


<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('registration_types', function (Blueprint $table) {
            $table->commonSaasFields();

            $table->string('name'); // Admission, Vendor, Affiliation
            $table->string('code')->unique(); // admission, vendor
            $table->boolean('is_active')->default(true);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registration_types');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('registrations', function (Blueprint $table) {
		    $table->commonSaasFields(); // includes id, tenant_id, timestamps, softDeletes

		    //$table->foreignId('user_id')->constrained()->cascadeOnDelete();

		    $table->string('type'); // admission, affiliation, exam, scholarship
		    $table->string('registration_status')->default('draft');

		    $table->timestamp('submitted_at')->nullable();
		});

    }

    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
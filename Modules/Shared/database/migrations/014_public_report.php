<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
       Schema::create('public_reports', function (Blueprint $table) {
			$table->id();

			$table->unsignedBigInteger('report_id')->nullable(); // optional link to a base report template (if needed)

			$table->string('module'); // when using without a base report template, this indicates which module's data to report on
			                         // e.g. 'employee', 'student', etc. This helps in resolving the model and columns for the report.
			$table->string('name')->nullable();
			$table->text('description')->nullable();
		    
			$table->unsignedBigInteger('tenant_id')->nullable();
			$table->json('filters')->nullable(); // ✅ Store report filters as JSON
			$table->string('allowed_domain')->nullable(); // Optional: restrict access to specific email domains (e.g. for internal reports)
		    $table->string('token')->unique();

		    $table->timestamp('expires_at')->nullable();
		    $table->boolean('is_active')->default(true);

		    $table->timestamps();

		    //$table->foreign('report_id')->references('id')->on('reports')->cascadeOnDelete();
		});

    }

    public function down(): void
    {
        Schema::dropIfExists('public_reports');
    }
};

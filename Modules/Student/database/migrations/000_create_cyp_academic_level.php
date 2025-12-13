<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('academic_levels', function (Blueprint $table) {
		    $table->id();

		    $table->string('name');              // Class 1, B.Tech, First Year, Section A
		    $table->string('short_name')->nullable(); // C1, BT, FY, A

		    $table->enum('type', [
		        'class',        // Class 1, Class 2
        		'course',       // B.Tech, B.Sc
		        'year',         // 1st year, 2nd year
        		'semester',     // Sem 1, Sem 2
		        'section'       // A, B, C
		    ]);

		    // For hierarchy (Self relationship)
		    $table->foreignId('parent_id')
        	  ->nullable()
	          ->constrained('academic_levels')
    	      ->onDelete('cascade');

		    // Meta controls
		    $table->integer('order_no')->default(1);   // For sorting like Year 1 → Year 2

		    $table->boolean('is_active')->default(true);

		    $table->timestamps();
		});
    }

    public function down(): void
    {
        Schema::dropIfExists('academic_levels');
    }
};

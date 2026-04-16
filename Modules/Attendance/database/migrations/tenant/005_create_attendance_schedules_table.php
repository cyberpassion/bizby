<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendance_schedules', function (Blueprint $table) {
		    $table->commonSaasFields();

		    $table->string('type');  
		    // lecture / shift / day etc.

		    $table->string('context')->nullable();  
		    // Room 204 / Batch A

		    $table->string('reference')->nullable();  
		    // Lecture / Period / Subject

		    $table->time('start_time');
		    $table->time('end_time');

		    $table->json('weekdays'); 
		    // [1,2,3,4,5] → Mon–Fri (ISO-8601)

		    $table->date('starts_from');
		    $table->date('ends_on')->nullable();

		    $table->nullableMorphs('owner');  
		    // Teacher / Department / Batch etc.

		    $table->boolean('is_active')->default(true);

		    $table->index(['tenant_id', 'type']);
		});

    }

    public function down(): void
    {
        Schema::dropIfExists('attendance_schedules');
    }
};

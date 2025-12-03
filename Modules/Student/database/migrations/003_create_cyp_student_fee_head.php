<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cyp_student_fee_head', function (Blueprint $table) {
	        $table->id();
    	    $table->string('name');
        	$table->string('frequency'); // monthly / yearly / one_time / custom
        	$table->decimal('default_amount', 10, 2)->default(0);
	        $table->timestamps();
    	});
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_fee_head');
    }
};

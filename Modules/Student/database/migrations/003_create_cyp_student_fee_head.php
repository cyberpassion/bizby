<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cyp_fee_head', function (Blueprint $table) {
            $table->id();

            $table->string('name'); // Tuition, Bus Fee, Admission, Exam Fee
            $table->string('frequency')->nullable();
            // monthly, quarterly, yearly, one_time, custom

            $table->decimal('default_amount', 10, 2)->default(0);
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_fee_head');
    }
};

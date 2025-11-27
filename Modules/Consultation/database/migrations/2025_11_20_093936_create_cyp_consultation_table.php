<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cyp_consultation', function (Blueprint $table) {

            // Common SaaS fields (id, client_id, status, timestamps, soft deletes, audit)
            $table->commonSaasFields();

            // Consultation-specific fields
            $table->unsignedBigInteger('consultation_group_id')->nullable();
            $table->date('consultation_date')->nullable();
            $table->time('consultation_time')->nullable();
            $table->unsignedBigInteger('day_token_id')->nullable();
            $table->string('channel')->nullable();

			// Polymorphic relation to consultant (could be User, Doctor, etc.)
            $table->nullableMorphs('consultant');

            $table->text('reason')->nullable();

            // Patient/person info using macro
            $table->commonPersonFields();

            // Other consultation fields 
            $table->string('consultation_type')->nullable();
            $table->decimal('consultation_fee', 10, 2)->nullable();
            $table->string('referred_by')->nullable();
            $table->string('referred_to')->nullable();
            $table->text('remark')->nullable();
            $table->string('followup_interval_days')->nullable();
            $table->date('next_date')->nullable();
            $table->unsignedBigInteger('thread_parent')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_consultation');
    }
};

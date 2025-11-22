<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cyp_visitplanner', function (Blueprint $table) {

            // Primary & Foreign Keys
            $table->bigInteger('client_id')->index();
            $table->bigIncrements('id_primary'); 

            $table->bigInteger('visitplanner_id')->index();

            $table->string('visit_by_type', 64);
            $table->bigInteger('visit_by_id')->index();
            $table->bigInteger('created_by_id')->index();

            // Session Info
            $table->string('session', 64);
            $table->string('month', 64);
            $table->string('week', 64);

            // JSON Fields
            $table->longText('visitplanner_data');
            $table->longText('visit_team_member_json')->nullable();

            // Visit Details
            $table->date('visit_date')->nullable();
            $table->time('visit_time')->nullable();
            $table->string('state', 64)->nullable();
            $table->text('district')->nullable();
            $table->text('visit_address')->nullable();
            $table->text('visit_company')->nullable();
            $table->string('visit_company_type', 64)->nullable();
            $table->text('visit_meetingwith')->nullable();
            $table->string('visit_email', 255)->nullable();
            $table->string('visit_mobile_number', 255)->nullable();
            $table->string('visit_website', 255)->nullable();
            $table->text('visit_product')->nullable();
            $table->text('visit_reason')->nullable();
            $table->text('visit_expectation')->nullable();
            $table->text('visit_expectedexpense')->nullable();

            // Entry Source
            $table->string('entry_source', 64)->nullable();
            $table->bigInteger('entry_source_id')->nullable()->index();
            $table->string('entry_source_type', 255)->nullable();

            // Audit Fields
            $table->string('visit_by', 255)->nullable();
            $table->string('created_by_type', 255)->nullable();
            $table->string('created_by', 255)->nullable();

            // Timestamps
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_visitplanner');
    }
};


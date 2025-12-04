<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('announcements', function (Blueprint $table) {

            //  Auto applies:
            // id, client_id, status, created_by, updated_by, deleted_by, deleted_at, timestamps
            $table->commonSaasFields();

            //  Custom fields
            $table->unsignedBigInteger('announcement_id')->nullable()->index();

            $table->string('session', 255)->nullable();
            $table->string('month', 255)->nullable();

            $table->date('end_date')->nullable();

            $table->string('category', 255)->nullable();
            $table->string('recipient', 255)->nullable();

            $table->longText('announcement')->nullable();

            $table->string('added_by_type', 255)->nullable();
            $table->unsignedBigInteger('added_by_id')->nullable()->index();
            $table->string('added_by', 255)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};


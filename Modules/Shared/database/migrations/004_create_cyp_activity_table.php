<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cyp_activity', function (Blueprint $table) {
            $table->bigIncrements('activity_id');

            $table->string('stimulus', 255);
            $table->string('module', 255)->nullable();
            $table->string('activity', 255);
            $table->string('operation', 255);
            $table->string('key', 255);

            $table->longText('summary_json')->nullable();

            $table->unsignedBigInteger('user_id');
            $table->tinyInteger('status');

            $table->bigInteger('client_id')->nullable();

            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_activity');
    }
};

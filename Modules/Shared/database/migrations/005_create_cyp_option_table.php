<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cyp_option', function (Blueprint $table) {
            $table->bigIncrements('option_id');

            $table->longText('option_name')->nullable();
            $table->longText('option_value')->nullable();

            $table->string('autoload', 255);

            $table->bigInteger('client_id')->nullable();

            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_option');
    }
};

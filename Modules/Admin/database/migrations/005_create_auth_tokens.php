<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('auth_tokens', function (Blueprint $table) {
		    $table->id();

		    // Who this token belongs to
		    $table->morphs('tokenable'); 
		    // User | Admin | Staff | Patient

		    // otp | password_reset | email_verify | magic_link
		    $table->string('type');

		    // hashed value (never store raw OTP/token)
		    $table->string('token');

		    // optional metadata
		    $table->json('meta')->nullable();

		    // lifecycle
		    $table->timestamp('expires_at');
		    $table->timestamp('used_at')->nullable();

		    // security
		    $table->unsignedTinyInteger('attempts')->default(0);

		    $table->timestamps();

		    // indexes
    		$table->index(['type', 'expires_at']);
		});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auth_tokens');
    }
};

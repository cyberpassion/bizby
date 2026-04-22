<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('note_thread_participants', function (Blueprint $table) {

		$table->commonSaasFields();

	    $table->foreignId('note_thread_id')->constrained()->cascadeOnDelete();

	    $table->nullableMorphs('participant');

	    $table->timestamp('last_read_at')->nullable();

	    $table->boolean('is_admin')->default(false);

		});
    }

    public function down(): void
    {
        Schema::dropIfExists('note_thread_participants');
    }
};

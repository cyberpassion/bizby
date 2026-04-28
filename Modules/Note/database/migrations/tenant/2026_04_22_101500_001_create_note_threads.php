<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('note_threads', function (Blueprint $table) {

		    $table->commonSaasFields();

		    // Thread info
		    $table->string('type')->nullable();
    		$table->boolean('is_internal')->default(false);

		    $table->string('subject')->nullable();
		    $table->string('priority')->nullable();

		    // 🔥 CONTEXT (what this is about)
		    $table->nullableMorphs('context');

		    // Metadata
		    $table->timestamp('last_message_at')->nullable();
		    $table->text('last_message')->nullable();

		    $table->index(['status', 'priority']);
		});
    }

    public function down(): void
    {
        Schema::dropIfExists('note_threads');
    }
};

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
		    $table->string('type')->nullable(); // support, internal

			// Internal / External (IMPORTANT)
		    $table->boolean('is_internal')->default(false);
		    /*
        		false → public / grievance / customer-facing
		        true  → internal communication
		    */

		    $table->string('subject')->nullable();

		    // Priority (for grievance)
		    $table->string('priority')->nullable(); // low, medium, high

		    // Assignment
		    $table->nullableMorphs('assigned_to');

		    // Metadata
		    $table->timestamp('last_message_at')->nullable();
		    $table->text('last_message')->nullable();

		    // Performance
		    $table->unsignedInteger('unread_count')->default(0);

		});
    }

    public function down(): void
    {
        Schema::dropIfExists('note_threads');
    }
};

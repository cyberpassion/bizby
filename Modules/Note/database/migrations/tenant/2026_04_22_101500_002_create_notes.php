<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notes', function (Blueprint $table) {

		    $table->commonSaasFields();

		    $table->foreignId('note_thread_id')
		          ->constrained()
        		  ->cascadeOnDelete();

		    // Sender only (receiver not needed)
		    $table->nullableMorphs('sender');

		    // Message
		    $table->text('message')->nullable();

		    $table->string('message_type')->default('text');
		    /*
        		text
		        system
        		attachment
		    */

		    // Attachments (optional JSON or separate table)
    		$table->json('attachments')->nullable();

		    // Read tracking (optional per user handled in participants)
		    $table->timestamp('read_at')->nullable();

		    $table->index('note_thread_id');
		});
    }

    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};

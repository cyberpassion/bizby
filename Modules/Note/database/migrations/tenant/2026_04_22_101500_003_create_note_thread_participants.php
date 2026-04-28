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

		    $table->foreignId('note_thread_id')
	          ->constrained()
    	      ->cascadeOnDelete();

		    // polymorphic participant
		    $table->morphs('participant');

		    // 🔥 STRICT ROLES
		    $table->enum('role', [
        		'initiator',
		        'assignee',
        		'watcher',
		        'previous_assignee',
        		'escalated_to'
		    ]);

		    // read tracking (per user)
    		$table->timestamp('last_read_at')->nullable();

		    // 🔥 performance indexes
		    $table->index(['note_thread_id', 'role']);
    		$table->index(['participant_id', 'participant_type']);

		    // prevent duplicates
		    $table->unique(
			    ['note_thread_id', 'participant_id', 'participant_type', 'role'],
    			'ntp_unique_participant_role'
			);
		});
    }

    public function down(): void
    {
        Schema::dropIfExists('note_thread_participants');
    }
};

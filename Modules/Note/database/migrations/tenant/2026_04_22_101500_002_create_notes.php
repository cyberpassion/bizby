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

		    // sender
		    $table->nullableMorphs('sender');

		    $table->text('message')->nullable();

		    $table->string('message_type')->default('text');
		    // text, system, attachment

		    $table->json('attachments')->nullable();

		    $table->index('note_thread_id');
		});
    }

    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};

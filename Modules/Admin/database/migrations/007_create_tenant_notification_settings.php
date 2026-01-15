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
        Schema::create('tenant_notification_settings', function ($table) {
		    $table->id();
    		$table->unsignedBigInteger('tenant_id');
	    	$table->string('activity_key');
	    	$table->string('channel'); // email | sms | whatsapp
		    $table->boolean('enabled')->default(true);
    		$table->timestamps();
		});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenant_notification_settings');
    }
};

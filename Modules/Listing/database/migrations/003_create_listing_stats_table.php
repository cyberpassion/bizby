<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('listing_stats', function (Blueprint $table) {
		    // Common SaaS fields
    		$table->commonSaasFields();

		    $table->unsignedBigInteger('listing_id');

		    $table->unsignedInteger('views')->default(0);
		    $table->unsignedInteger('unique_views')->default(0);
		    $table->unsignedInteger('contacts_clicked')->default(0);
    		$table->unsignedInteger('website_clicked')->default(0);
    		$table->unsignedInteger('whatsapp_clicked')->default(0);

		    $table->date('date'); // daily aggregation

		    $table->unique(['listing_id', 'date']);
    		$table->index(['listing_id']);
		});
    }

    public function down(): void
    {
        Schema::dropIfExists('listing_stats');
    }
};
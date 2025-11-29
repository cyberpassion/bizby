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
        Schema::create('cyp_tenant', function (Blueprint $table) {
            $table->id();
            $table->string('name');                 // Tenant / Client Name
            $table->string('code')->unique();       // Short code like XYZUNI
            $table->string('domain')->nullable();   // website or subdomain
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            
            // Billing / SaaS Metadata
            $table->string('plan')->nullable();     // basic/premium/etc.
            $table->date('valid_till')->nullable(); // subscription validity

            // Status
            $table->boolean('is_active')->default(true);

            // JSON settings (optional)
            $table->json('settings')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cyp_tenant');
    }
};

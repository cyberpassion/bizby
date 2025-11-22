<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cyp_booking', function (Blueprint $table) {
            // Common SaaS fields
            $table->commonSaasFields();

            // Booking-specific fields
            $table->unsignedBigInteger('booking_group_id')->nullable();
            $table->bigInteger('booking_id_sno');
            $table->unsignedBigInteger('building_id');
            $table->unsignedBigInteger('occupant_id')->nullable();
            $table->string('occupant_type', 128)->nullable();
            $table->string('booking_type', 128);
            $table->unsignedBigInteger('slot_id')->nullable();

            // Polymorphic style for user references
            $table->string('booking_done_by_type')->nullable();
            $table->unsignedBigInteger('booking_done_by_id')->nullable();
            $table->string('booking_done_by_mobile')->nullable();
            $table->string('booking_done_by_email')->nullable();

            $table->unsignedTinyInteger('space_id')->nullable();
            $table->unsignedBigInteger('max_occupant_count')->nullable();
            $table->text('features')->nullable();
            $table->dateTime('expected_checkin_datetime')->nullable();
            $table->dateTime('checkin_datetime')->nullable();

            $table->string('checkin_done_by_type')->nullable();
            $table->unsignedBigInteger('checkin_done_by_id')->nullable();
            $table->text('checkin_remark')->nullable();

            $table->dateTime('expected_checkout_datetime')->nullable();
            $table->dateTime('checkout_datetime')->nullable();

            $table->string('checkout_done_by_type')->nullable();
            $table->unsignedBigInteger('checkout_done_by_id')->nullable();
            $table->text('checkout_remark')->nullable();

            $table->boolean('is_checked_out')->default(false);

            $table->boolean('is_cash_verified')->default(false);
            $table->string('cash_verified_by_type')->nullable();
            $table->unsignedBigInteger('cash_verified_by_id')->nullable();
            $table->text('cash_verification_remark')->nullable();

            $table->longText('remark')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_booking');
    }
};

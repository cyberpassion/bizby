<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cyp_booking', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_group_id')->nullable();
            $table->bigInteger('booking_id_sno');
            $table->dateTime('datetime');
            $table->date('date');
            $table->unsignedBigInteger('building_id');
            $table->unsignedBigInteger('occupant_id')->nullable();
            $table->string('occupant_type', 128)->nullable();
            $table->string('booking_type', 128);
            $table->unsignedBigInteger('slot_id')->nullable();
            $table->text('booking_done_by_type');
            $table->text('booking_done_by');
            $table->text('booking_done_by_mobile');
            $table->text('booking_done_by_email');
            $table->unsignedTinyInteger('space_id')->nullable();
            $table->unsignedBigInteger('max_occupant_count')->nullable();
            $table->text('features')->nullable();
            $table->dateTime('expected_checkin_datetime')->nullable();
            $table->dateTime('checkin_datetime')->nullable();
            $table->bigInteger('checkin_done_by');
            $table->text('checkin_remark')->nullable();
            $table->dateTime('expected_checkout_datetime')->nullable();
            $table->dateTime('checkout_datetime')->nullable();
            $table->bigInteger('checkout_done_by');
            $table->text('checkout_remark')->nullable();
            $table->boolean('is_checked_out');
            $table->boolean('is_cash_verified');
            $table->bigInteger('cash_verified_by');
            $table->text('cash_verification_remark')->nullable();
            $table->tinyInteger('status');
            $table->longText('remark')->nullable();
            $table->bigInteger('client_id')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_booking');
    }
};


<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cashflows', function (Blueprint $table) {

            // =========================
            // Common SaaS fields
            // =========================
            /*
                id
                client_id
                created_by
                updated_by
                deleted_by
                timestamps
                soft deletes
            */
            $table->commonSaasFields();

            // =========================
            // Direction of money
            // =========================
            $table->string('direction');
            /*
                in  → income / incoming
                out → expense / outgoing
            */

            // =========================
            // Amount
            // =========================
            $table->decimal('amount', 12, 2);

            // =========================
            // Date of transaction
            // =========================
            $table->date('transaction_date');

            // =========================
            // Classification (what is this money for)
            // =========================
            $table->string('category')->nullable();
            /*
                fee
                salary
                rent
                donation
                purchase
            */

            $table->string('sub_category')->nullable();
            /*
                tuition_fee
                electricity
                internet
            */

            // =========================
            // Payment mode
            // =========================
            $table->string('payment_mode')->nullable();
            /*
                cash
                bank
                upi
                card
                cheque
            */

            // =========================
            // Reference / receipt
            // =========================
            $table->string('reference_no')->nullable();

            // =========================
            // Party involved
            // =========================
            $table->nullableMorphs('party');
            /*
                Student
                User
                Vendor
                Employee
            */

            // =========================
            // Linked entity (optional)
            // =========================
            $table->nullableMorphs('related_to');
            /*
                Invoice
                Fee
                Salary
                Booking
            */

            // =========================
            // Notes
            // =========================
            $table->text('description')->nullable();

            // =========================
            // Indexes
            // =========================
            $table->index('direction');
            $table->index('transaction_date');
            $table->index(['category', 'sub_category']);
            $table->index(['party_id', 'party_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cashflows');
    }
};

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
        Schema::create('card_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('account_id')->constrained()->onDelete('cascade');
            $table->string('card_type'); // debit, credit
            $table->string('card_network'); // visa, mastercard
            $table->string('request_status')->default('pending'); // pending, under_review, approved, rejected, printed, shipped, delivered
            $table->string('delivery_address');
            $table->string('phone_number');
            $table->decimal('monthly_income', 15, 2)->nullable();
            $table->string('employment_status')->nullable();
            $table->decimal('credit_limit_requested', 15, 2)->nullable();
            $table->string('supporting_documents')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('card_requests');
    }
};

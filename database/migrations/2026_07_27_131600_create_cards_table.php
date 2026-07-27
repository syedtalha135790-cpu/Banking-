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
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('account_id')->constrained()->onDelete('cascade');
            $table->string('card_number');
            $table->string('card_type'); // debit, credit
            $table->string('card_network'); // visa, mastercard
            $table->date('expiry_date');
            $table->text('cvv'); // encrypted
            $table->string('status')->default('active'); // active, blocked, expired, pending
            $table->decimal('credit_limit', 15, 2)->default(0.00);
            $table->decimal('available_credit', 15, 2)->default(0.00);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cards');
    }
};

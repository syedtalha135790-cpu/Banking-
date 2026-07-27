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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_id')->constrained()->onDelete('cascade');
            $table->foreignId('sender_account_id')->nullable()->constrained('accounts')->onDelete('set null');
            $table->foreignId('receiver_account_id')->nullable()->constrained('accounts')->onDelete('set null');
            $table->string('transaction_type'); // deposit, withdrawal, transfer_in, transfer_out
            $table->decimal('amount', 15, 2);
            $table->decimal('balance_after_transaction', 15, 2);
            $table->string('description')->nullable();
            $table->string('status')->default('completed'); // completed, failed, pending
            $table->string('reference_number')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};

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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('account_id')->constrained()->onDelete('cascade');
            $table->string('loan_type'); // personal, home, car, education, business
            $table->decimal('amount', 15, 2);
            $table->decimal('interest_rate', 5, 2);
            $table->integer('duration'); // in months
            $table->decimal('monthly_emi', 15, 2)->default(0.00);
            $table->decimal('total_interest', 15, 2)->default(0.00);
            $table->decimal('total_payment', 15, 2)->default(0.00);
            $table->decimal('outstanding_balance', 15, 2)->default(0.00);
            $table->string('status')->default('pending'); // pending, under_review, approved, rejected, disbursed
            $table->timestamp('application_date')->useCurrent();
            $table->timestamp('approval_date')->nullable();
            $table->string('purpose_of_loan');
            $table->string('employment_status');
            $table->string('employer_name')->nullable();
            $table->decimal('monthly_income', 15, 2);
            $table->string('cnic');
            $table->string('supporting_documents')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};

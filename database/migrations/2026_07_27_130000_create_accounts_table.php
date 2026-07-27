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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('cnic')->unique();
            $table->date('dob');
            $table->text('address');
            $table->string('occupation');
            $table->decimal('monthly_income', 15, 2);
            $table->string('account_number')->unique();
            $table->string('account_type'); // savings, current
            $table->decimal('balance', 15, 2)->default(0.00);
            $table->decimal('interest_rate', 5, 2)->default(0.00);
            $table->decimal('minimum_balance', 15, 2)->default(0.00);
            $table->string('status')->default('active'); // active, inactive
            $table->string('ifsc_code')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([
    'user_id',
    'account_id',
    'loan_type',
    'amount',
    'interest_rate',
    'duration',
    'monthly_emi',
    'total_interest',
    'total_payment',
    'outstanding_balance',
    'status',
    'application_date',
    'approval_date',
    'purpose_of_loan',
    'employment_status',
    'employer_name',
    'monthly_income',
    'cnic',
    'supporting_documents'
])]
class Loan extends Model
{
    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'interest_rate' => 'decimal:2',
            'monthly_emi' => 'decimal:2',
            'total_interest' => 'decimal:2',
            'total_payment' => 'decimal:2',
            'outstanding_balance' => 'decimal:2',
            'monthly_income' => 'decimal:2',
            'application_date' => 'datetime',
            'approval_date' => 'datetime',
        ];
    }

    /**
     * Get the user who owns the loan.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the bank account associated with the loan disbursements/repayments.
     */
    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    /**
     * Get the loan payments (installments).
     */
    public function loanPayments()
    {
        return $this->hasMany(LoanPayment::class);
    }
}

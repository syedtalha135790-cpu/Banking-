<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([
    'loan_id',
    'installment_number',
    'due_date',
    'payment_date',
    'amount',
    'payment_status',
    'reference_number'
])]
class LoanPayment extends Model
{
    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'due_date' => 'date',
            'payment_date' => 'datetime',
        ];
    }

    /**
     * Get the loan that owns this installment payment.
     */
    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }
}

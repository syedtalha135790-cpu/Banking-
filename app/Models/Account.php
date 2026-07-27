<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([
    'user_id',
    'cnic',
    'dob',
    'address',
    'occupation',
    'monthly_income',
    'account_number',
    'account_type',
    'balance',
    'interest_rate',
    'minimum_balance',
    'status',
    'ifsc_code'
])]
class Account extends Model
{
    use SoftDeletes;

    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'dob' => 'date',
            'monthly_income' => 'decimal:2',
            'balance' => 'decimal:2',
            'interest_rate' => 'decimal:2',
            'minimum_balance' => 'decimal:2',
        ];
    }

    /**
     * Get the user that owns the account.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the transactions associated with the account.
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Check if account is active.
     */
    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    /**
     * Get the loans associated with the account.
     */
    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    /**
     * Get the cards associated with the account.
     */
    public function cards()
    {
        return $this->hasMany(Card::class);
    }
}

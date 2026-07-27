<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([
    'account_id',
    'sender_account_id',
    'receiver_account_id',
    'transaction_type',
    'amount',
    'balance_after_transaction',
    'description',
    'status',
    'reference_number'
])]
class Transaction extends Model
{
    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'balance_after_transaction' => 'decimal:2',
        ];
    }

    /**
     * Get the account that owns the transaction.
     */
    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }

    /**
     * Get the sender account.
     */
    public function senderAccount()
    {
        return $this->belongsTo(Account::class, 'sender_account_id');
    }

    /**
     * Get the receiver account.
     */
    public function receiverAccount()
    {
        return $this->belongsTo(Account::class, 'receiver_account_id');
    }
}

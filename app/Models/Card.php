<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([
    'user_id',
    'account_id',
    'card_number',
    'card_type',
    'card_network',
    'expiry_date',
    'cvv',
    'status',
    'credit_limit',
    'available_credit'
])]
class Card extends Model
{
    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'cvv' => 'encrypted',
            'expiry_date' => 'date',
            'credit_limit' => 'decimal:2',
            'available_credit' => 'decimal:2',
        ];
    }

    /**
     * Get user associated with the card.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get bank account associated with the card.
     */
    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    /**
     * Get the masked card number (e.g. **** **** **** 1234)
     */
    public function getMaskedNumberAttribute()
    {
        return '••••  ••••  ••••  ' . substr($this->card_number, -4);
    }
}

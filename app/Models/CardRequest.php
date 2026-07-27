<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([
    'user_id',
    'account_id',
    'card_type',
    'card_network',
    'request_status',
    'delivery_address',
    'phone_number',
    'monthly_income',
    'employment_status',
    'credit_limit_requested',
    'supporting_documents'
])]
class CardRequest extends Model
{
    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'monthly_income' => 'decimal:2',
            'credit_limit_requested' => 'decimal:2',
        ];
    }

    /**
     * Get user associated with this card request.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get bank account associated with this card request.
     */
    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}

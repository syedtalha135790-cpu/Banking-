<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([
    'user_id',
    'beneficiary_name',
    'account_number',
    'bank_name',
    'branch_name',
    'branch_code',
    'swift_code',
    'relationship',
    'nickname',
    'email',
    'phone',
    'verification_status',
    'verified_at',
    'verified_by'
])]
class Beneficiary extends Model
{
    use SoftDeletes;

    /**
     * Get the user that registered this beneficiary.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the admin user who approved/verified this beneficiary.
     */
    public function verifiedBy()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    /**
     * Check if beneficiary is verified.
     */
    public function isVerified(): bool
    {
        return $this->verification_status === 'verified';
    }
}

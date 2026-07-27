<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'phone_number', 'otp_code', 'otp_expires_at', 'password', 'role'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'otp_expires_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the accounts associated with the user.
     */
    public function accounts()
    {
        return $this->hasMany(Account::class);
    }

    /**
     * Get the beneficiaries registered by the user.
     */
    public function beneficiaries()
    {
        return $this->hasMany(Beneficiary::class);
    }

    /**
     * Get the loans associated with the user.
     */
    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    /**
     * Get the cards registered to the user.
     */
    public function cards()
    {
        return $this->hasMany(Card::class);
    }

    /**
     * Get the card requests submitted by the user.
     */
    public function cardRequests()
    {
        return $this->hasMany(CardRequest::class);
    }
}

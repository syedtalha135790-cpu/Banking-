<?php

namespace App\Services;

use App\Models\User;
use App\Notifications\VerifyEmailNotification;
use Carbon\Carbon;

class EmailVerificationService
{
    /**
     * Generate a new OTP code for the user and send verification email.
     */
    public function sendOTP(User $user): void
    {
        // Generate random 4-digit code (or default mock 1234 for easy testing, but let's do a real 4-digit code!)
        $otp = (string) rand(1000, 9999);
        
        // Save to user
        $user->forceFill([
            'otp_code' => $otp,
            'otp_expires_at' => Carbon::now()->addMinutes(15),
        ])->save();

        // Dispatch Notification
        try {
            $user->notify(new VerifyEmailNotification($otp));
        } catch (\Exception $e) {
            \Log::warning("Failed to send verification email via SMTP: " . $e->getMessage() . ". Fallback OTP Code: " . $otp);
        }
    }

    /**
     * Validate the OTP code input.
     */
    public function verifyOTP(User $user, string $code): bool
    {
        if (empty($user->otp_code) || empty($user->otp_expires_at)) {
            return false;
        }

        // Check if matching code and within expiration time
        if ($user->otp_code === $code && Carbon::now()->lessThanOrEqualTo($user->otp_expires_at)) {
            // Activate account
            $user->forceFill([
                'email_verified_at' => Carbon::now(),
                'otp_code' => null,
                'otp_expires_at' => null,
            ])->save();

            return true;
        }

        return false;
    }
}

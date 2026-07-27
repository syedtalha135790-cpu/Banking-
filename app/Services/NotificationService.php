<?php

namespace App\Services;

use App\Models\User;
use App\Models\Notification;
use App\Mail\BankingActivityMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class NotificationService
{
    /**
     * Send system alert & queue HTML email.
     */
    public static function send($userId, $title, $message, $type, $reference = null, $emailDetails = null)
    {
        try {
            $user = User::findOrFail($userId);

            // Log notification to Database
            $notification = Notification::create([
                'user_id' => $userId,
                'title' => $title,
                'message' => $message,
                'notification_type' => $type,
                'reference_number' => $reference,
                'is_read' => false,
                'sent_via' => $emailDetails ? 'database/email' : 'database',
            ]);

            // Queue email notification if details are provided
            if ($emailDetails && $user->email) {
                $payload = [
                    'subject' => $title,
                    'title' => $title,
                    'recipient_name' => $user->name,
                    'details' => $emailDetails['details'] ?? [],
                    'reference_number' => $reference,
                    'note' => $emailDetails['note'] ?? $message,
                ];

                Mail::to($user->email)->queue(new BankingActivityMail($payload));
            }

            return $notification;
        } catch (\Exception $e) {
            // Log delivery failure for administration audit
            Log::error("Failed to send notification: " . $e->getMessage());
            return null;
        }
    }
}

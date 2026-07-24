<?php

namespace App\Notifications;

use App\Mail\VerifyEmail as VerifyEmailMailable;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class VerifyEmailNotification extends Notification
{
    use Queueable;

    protected $otpCode;

    /**
     * Create a new notification instance.
     */
    public function __construct($otpCode)
    {
        $this->otpCode = $otpCode;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): VerifyEmailMailable
    {
        return (new VerifyEmailMailable($this->otpCode))
            ->to($notifiable->email);
    }
}

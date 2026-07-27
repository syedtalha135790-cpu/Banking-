<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Mail\BankingActivityMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminNotificationController extends Controller
{
    /**
     * Display listing of all notifications in the system.
     */
    public function index(Request $request)
    {
        $query = Notification::with('user');

        // Search title/message/recipient name
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%")
                  ->orWhere('reference_number', 'like', "%{$search}%")
                  ->orWhereHas('user', function($userQ) use ($search) {
                      $userQ->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        // Filter Notification Type
        if ($request->filled('type')) {
            $query->where('notification_type', $request->type);
        }

        // Filter Read Status
        if ($request->filled('status')) {
            $isRead = $request->status === 'read' ? true : false;
            $query->where('is_read', $isRead);
        }

        $notifications = $query->orderBy('id', 'desc')->paginate(15)->withQueryString();

        return view('admin.notifications.index', compact('notifications'));
    }

    /**
     * Resend notification email.
     */
    public function resend($id)
    {
        $notification = Notification::with('user')->findOrFail($id);

        if (!$notification->user || !$notification->user->email) {
            return back()->withErrors(['error' => 'Failed to resend. Recipient user email is unavailable.']);
        }

        $payload = [
            'subject' => '[RESENT] ' . $notification->title,
            'title' => $notification->title,
            'recipient_name' => $notification->user->name,
            'details' => [
                'Log Reference ID' => $notification->reference_number ?? 'N/A',
                'Alert Details' => $notification->message,
                'Original Timestamp' => $notification->created_at->format('Y-m-d H:i:s'),
                'Resend Timestamp' => now()->format('Y-m-d H:i:s'),
            ],
            'reference_number' => $notification->reference_number,
            'note' => $notification->message,
        ];

        try {
            Mail::to($notification->user->email)->queue(new BankingActivityMail($payload));
            return back()->with('success', 'Notification alert successfully re-queued for email delivery.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to resend email: ' . $e->getMessage()]);
        }
    }
}

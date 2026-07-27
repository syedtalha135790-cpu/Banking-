<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\CardRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminCardController extends Controller
{
    /**
     * Display all card requests, active cards & metrics.
     */
    public function index(Request $request)
    {
        $cardRequests = CardRequest::with(['user', 'account']);
        $issuedCards = Card::with(['user', 'account']);

        // Search in card requests
        if ($request->filled('search')) {
            $search = $request->search;
            $cardRequests->where(function($q) use ($search) {
                $q->where('phone_number', 'like', "%{$search}%")
                  ->orWhereHas('user', function($uQ) use ($search) {
                      $uQ->where('name', 'like', "%{$search}%");
                  });
            });
            
            $issuedCards->where(function($q) use ($search) {
                $q->where('card_number', 'like', "%{$search}%")
                  ->orWhereHas('user', function($uQ) use ($search) {
                      $uQ->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // Filters card requests
        if ($request->filled('status')) {
            $cardRequests->where('request_status', $request->status);
        }
        if ($request->filled('type')) {
            $cardRequests->where('card_type', $request->type);
            $issuedCards->where('card_type', $request->type);
        }

        $requests = $cardRequests->orderBy('id', 'desc')->paginate(10, ['*'], 'requests_page')->withQueryString();
        $cards = $issuedCards->orderBy('id', 'desc')->paginate(10, ['*'], 'cards_page')->withQueryString();

        // Metrics calculations
        $totalRequests = CardRequest::count();
        $pendingRequests = CardRequest::whereIn('request_status', ['pending', 'under_review'])->count();
        $approvedCards = Card::count();
        $activeCards = Card::where('status', 'active')->count();
        $blockedCards = Card::where('status', 'blocked')->count();
        $debitCards = Card::where('card_type', 'debit')->count();
        $creditCards = Card::where('card_type', 'credit')->count();

        return view('admin.cards.index', compact(
            'requests',
            'cards',
            'totalRequests',
            'pendingRequests',
            'approvedCards',
            'activeCards',
            'blockedCards',
            'debitCards',
            'creditCards'
        ));
    }

    /**
     * Show card request evaluation details.
     */
    public function show($id)
    {
        $request = CardRequest::with(['user', 'account'])->findOrFail($id);
        return view('admin.cards.show', compact('request'));
    }

    /**
     * Approve card request & generate card number.
     */
    public function approve(Request $request, $id)
    {
        $cardRequest = CardRequest::findOrFail($id);

        if (in_array($cardRequest->request_status, ['approved', 'rejected'])) {
            return back()->withErrors(['error' => 'This request has already been processed.']);
        }

        // Generate unique 16-digit card number
        // Visa starts with 4111, MasterCard starts with 5111
        $prefix = $cardRequest->card_network === 'visa' ? '4111' : '5111';
        
        do {
            $cardNumber = $prefix . rand(1000, 9999) . rand(1000, 9999) . rand(1000, 9999);
        } while (Card::where('card_number', $cardNumber)->exists());

        $expiryDate = now()->addYears(5)->toDateString();
        $cvv = (string) rand(100, 999);

        // Credit limit definition
        $limit = 0.00;
        if ($cardRequest->card_type === 'credit') {
            $limit = $cardRequest->credit_limit_requested ?? 50000.00;
        }

        // Create Card record
        Card::create([
            'user_id' => $cardRequest->user_id,
            'account_id' => $cardRequest->account_id,
            'card_number' => $cardNumber,
            'card_type' => $cardRequest->card_type,
            'card_network' => $cardRequest->card_network,
            'expiry_date' => $expiryDate,
            'cvv' => $cvv, // Encrypted transparently by Eloquent cast
            'status' => 'active',
            'credit_limit' => $limit,
            'available_credit' => $limit,
        ]);

        // Update Request status
        $cardRequest->update([
            'request_status' => 'approved',
        ]);

        // Trigger Card Approved Notification
        \App\Services\NotificationService::send(
            $cardRequest->user_id,
            'Card Request Approved',
            "Congratulations! Your request for a new " . ucfirst($cardRequest->card_type) . " card has been approved.",
            'card',
            'CARD-REQ-' . $cardRequest->id,
            [
                'details' => [
                    'Card Category' => ucfirst($cardRequest->card_type) . ' Card',
                    'Card Network' => strtoupper($cardRequest->card_network),
                    'Evaluation Status' => 'Approved',
                    'Delivery Target' => $cardRequest->delivery_address,
                    'Date Approved' => now()->toDateString(),
                ]
            ]
        );

        // Log Card Approved activity
        \App\Services\ActivityLogger::log('card_approved', 'card', "Admin approved Card Request ID #{$cardRequest->id} (Type: {$cardRequest->card_type}).", Auth::id(), 'success');

        return redirect()->route('admin.cards.index')->with('success', 'Card request approved. Card generated successfully.');
    }

    /**
     * Reject card request.
     */
    public function reject($id)
    {
        $cardRequest = CardRequest::findOrFail($id);

        if (in_array($cardRequest->request_status, ['approved', 'rejected'])) {
            return back()->withErrors(['error' => 'This request has already been processed.']);
        }

        $cardRequest->update([
            'request_status' => 'rejected',
        ]);

        // Trigger Card Rejected Notification
        \App\Services\NotificationService::send(
            $cardRequest->user_id,
            'Card Request Rejected',
            "We regret to inform you that your request for a " . ucfirst($cardRequest->card_type) . " card request ID #{$cardRequest->id} has been rejected.",
            'card',
            'CARD-REQ-' . $cardRequest->id,
            [
                'details' => [
                    'Card Category' => ucfirst($cardRequest->card_type) . ' Card',
                    'Card Network' => strtoupper($cardRequest->card_network),
                    'Evaluation Status' => 'Rejected',
                    'Review Date' => now()->toDateString(),
                ]
            ]
        );

        // Log Card Rejected activity
        \App\Services\ActivityLogger::log('card_rejected', 'card', "Admin rejected Card Request ID #{$cardRequest->id}.", Auth::id(), 'success');

        return redirect()->route('admin.cards.index')->with('success', 'Card request rejected.');
    }

    /**
     * Block / Unblock card.
     */
    public function toggleStatus($id)
    {
        $card = Card::findOrFail($id);
        $newStatus = $card->status === 'active' ? 'blocked' : 'active';
        $card->update(['status' => $newStatus]);

        // Log Card Status toggle activity
        \App\Services\ActivityLogger::log('card_status_toggle', 'card', "Admin toggled card ending in " . substr($card->card_number, -4) . " status to " . ucfirst($newStatus) . ".", Auth::id(), 'success');

        return redirect()->route('admin.cards.index')->with('success', "Card ending in " . substr($card->card_number, -4) . " status updated to " . ucfirst($newStatus) . ".");
    }

    /**
     * Update delivery status phase.
     */
    public function updateDeliveryStatus(Request $request, $id)
    {
        $request->validate([
            'delivery_status' => ['required', 'string', 'in:under_review,printed,shipped,delivered'],
        ]);

        $cardRequest = CardRequest::findOrFail($id);
        $cardRequest->update([
            'request_status' => $request->delivery_status,
        ]);

        return redirect()->route('admin.cards.index')->with('success', 'Shipping delivery status updated successfully.');
    }
}

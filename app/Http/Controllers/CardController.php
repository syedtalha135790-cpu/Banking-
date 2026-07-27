<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Card;
use App\Models\CardRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CardController extends Controller
{
    /**
     * Customer Card Dashboard.
     */
    public function index()
    {
        $cards = Card::where('user_id', Auth::id())->with('account')->orderBy('id', 'desc')->get();
        $requests = CardRequest::where('user_id', Auth::id())->with('account')->orderBy('id', 'desc')->get();

        return view('customer.cards.index', compact('cards', 'requests'));
    }

    /**
     * Show form to request debit card.
     */
    public function requestDebitForm()
    {
        $accounts = Account::where('user_id', Auth::id())->where('status', 'active')->get();

        if ($accounts->isEmpty()) {
            return redirect()->route('customer.cards.index')
                ->withErrors(['account' => 'You must have an Active bank account to request a Debit Card.']);
        }

        return view('customer.cards.request_debit', compact('accounts'));
    }

    /**
     * Store debit card request.
     */
    public function storeDebitRequest(Request $request)
    {
        $request->validate([
            'account_id' => ['required', 'exists:accounts,id'],
            'card_network' => ['required', 'string', 'in:visa,mastercard'],
            'delivery_address' => ['required', 'string', 'max:500'],
            'phone_number' => ['required', 'string', 'max:50'],
        ]);

        $account = Account::where('id', $request->account_id)->where('user_id', Auth::id())->firstOrFail();

        if (!$account->isActive()) {
            return back()->withErrors(['account_id' => 'The selected bank account is Inactive.'])->withInput();
        }

        // Rule: One active debit card per account
        $hasActiveCard = Card::where('account_id', $account->id)
            ->where('card_type', 'debit')
            ->whereIn('status', ['active', 'pending'])
            ->exists();

        $hasPendingRequest = CardRequest::where('account_id', $account->id)
            ->where('card_type', 'debit')
            ->whereIn('request_status', ['pending', 'under_review'])
            ->exists();

        if ($hasActiveCard || $hasPendingRequest) {
            return back()->withErrors(['account_id' => 'This account already has an active debit card or an outstanding request.'])->withInput();
        }

        CardRequest::create([
            'user_id' => Auth::id(),
            'account_id' => $account->id,
            'card_type' => 'debit',
            'card_network' => $request->card_network,
            'request_status' => 'pending',
            'delivery_address' => $request->delivery_address,
            'phone_number' => $request->phone_number,
        ]);

        return redirect()->route('customer.cards.index')->with('success', 'Debit card request submitted successfully.');
    }

    /**
     * Show form to request credit card.
     */
    public function requestCreditForm()
    {
        $accounts = Account::where('user_id', Auth::id())->where('status', 'active')->get();

        if ($accounts->isEmpty()) {
            return redirect()->route('customer.cards.index')
                ->withErrors(['account' => 'You must have an Active bank account to request a Credit Card.']);
        }

        return view('customer.cards.request_credit', compact('accounts'));
    }

    /**
     * Store credit card request.
     */
    public function storeCreditRequest(Request $request)
    {
        $request->validate([
            'account_id' => ['required', 'exists:accounts,id'],
            'card_network' => ['required', 'string', 'in:visa,mastercard'],
            'delivery_address' => ['required', 'string', 'max:500'],
            'phone_number' => ['required', 'string', 'max:50'],
            'monthly_income' => ['required', 'numeric', 'min:5000'],
            'employment_status' => ['required', 'string', 'in:employed,self-employed'],
            'credit_limit_requested' => ['required', 'numeric', 'min:10000', 'max:1000000'],
            'supporting_documents' => ['nullable', 'file', 'mimes:pdf,jpg,png', 'max:5120'],
        ]);

        $account = Account::where('id', $request->account_id)->where('user_id', Auth::id())->firstOrFail();

        if (!$account->isActive()) {
            return back()->withErrors(['account_id' => 'The selected bank account is Inactive.'])->withInput();
        }

        $documentPath = null;
        if ($request->hasFile('supporting_documents')) {
            $file = $request->file('supporting_documents');
            $filename = 'card_doc_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $documentPath = $file->storeAs('cards', $filename, 'public');
        }

        CardRequest::create([
            'user_id' => Auth::id(),
            'account_id' => $account->id,
            'card_type' => 'credit',
            'card_network' => $request->card_network,
            'request_status' => 'pending',
            'delivery_address' => $request->delivery_address,
            'phone_number' => $request->phone_number,
            'monthly_income' => $request->monthly_income,
            'employment_status' => $request->employment_status,
            'credit_limit_requested' => $request->credit_limit_requested,
            'supporting_documents' => $documentPath,
        ]);

        return redirect()->route('customer.cards.index')->with('success', 'Credit card application submitted successfully.');
    }

    /**
     * Block Lost / Stolen Card.
     */
    public function block($id)
    {
        $card = Card::where('user_id', Auth::id())->findOrFail($id);

        if ($card->status === 'blocked') {
            return back()->withErrors(['error' => 'This card is already blocked.']);
        }

        $card->update(['status' => 'blocked']);

        return redirect()->route('customer.cards.index')->with('success', "Card ending in {$card->card_number} has been blocked successfully.");
    }

    /**
     * Request Card Replacement.
     */
    public function replace($id)
    {
        $card = Card::where('user_id', Auth::id())->findOrFail($id);

        // Block card first
        $card->update(['status' => 'blocked']);

        // Generate replacement request
        CardRequest::create([
            'user_id' => Auth::id(),
            'account_id' => $card->account_id,
            'card_type' => $card->card_type,
            'card_network' => $card->card_network,
            'request_status' => 'pending',
            'delivery_address' => 'Stored branch / profile address',
            'phone_number' => Auth::user()->phone ?? '0000000000',
        ]);

        return redirect()->route('customer.cards.index')->with('success', 'Your old card has been blocked and a replacement request has been submitted.');
    }

    /**
     * Track Shipping status timeline.
     */
    public function track($id)
    {
        $request = CardRequest::where('user_id', Auth::id())->with('account')->findOrFail($id);
        return view('customer.cards.status', compact('request'));
    }
}

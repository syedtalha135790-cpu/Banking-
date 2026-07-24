<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureEmailIsVerified
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && is_null(Auth::user()->email_verified_at)) {
            session(['verify_email' => Auth::user()->email]);
            return redirect()->route('verification.notice')
                ->withErrors(['otp' => 'Your account must be verified before accessing this page.']);
        }

        return $next($request);
    }
}

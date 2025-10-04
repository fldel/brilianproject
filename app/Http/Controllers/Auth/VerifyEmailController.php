<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return $this->redirectByRole($request);
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return $this->redirectByRole($request);
    }

    private function redirectByRole(EmailVerificationRequest $request): RedirectResponse
    {
        $user = $request->user();
        if ($user && $user->role === 'admin') {
            return redirect()->intended(url('/admin/dashboard').'?verified=1');
        }
        return redirect()->intended(route('dashboard', absolute: false).'?verified=1');
    }
}

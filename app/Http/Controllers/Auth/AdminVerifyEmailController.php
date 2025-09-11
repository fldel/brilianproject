<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class AdminVerifyEmailController extends Controller
{
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user('organizers')->hasVerifiedEmail()) {
            return redirect()->route('admin.dashboard', ['verified' => 1]);
        }

        if ($request->user('organizers')->markEmailAsVerified()) {
            event(new Verified($request->user('organizers')));
        }

        return redirect()->route('admin.dashboard', ['verified' => 1]);
    }
}

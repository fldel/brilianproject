<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminEmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user('organizers')->hasVerifiedEmail()) {
            return redirect()->route('admin.dashboard');
        }

        $request->user('organizers')->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}

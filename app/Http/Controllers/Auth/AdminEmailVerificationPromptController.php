<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminEmailVerificationPromptController extends Controller
{
    public function __invoke(Request $request): RedirectResponse|View
    {
        return $request->user('organizers')->hasVerifiedEmail()
            ? redirect()->intended(route('admin.dashboard'))
            : view('admin.verify-email'); // bikin blade khusus admin
    }
}

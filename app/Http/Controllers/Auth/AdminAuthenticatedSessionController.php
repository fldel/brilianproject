<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Organizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminAuthenticatedSessionController extends Controller
{
    public function create(): View|RedirectResponse
    {
        if (Auth::guard('organizers')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required','string','email'],
            'password' => ['required','string'],
        ]);

        try {
            if (Auth::guard('organizers')->attempt($credentials, $request->boolean('remember'))) {
                $request->session()->regenerate();
                return redirect()->intended(route('admin.dashboard'));
            }
        } catch (\RuntimeException $e) {
            if (str_contains($e->getMessage(), 'does not use the Bcrypt')) {
                $organizer = Organizer::where('email', $credentials['email'])->first();
                if ($organizer && hash_equals((string) $organizer->password, (string) $credentials['password'])) {
                    $organizer->password = Hash::make($credentials['password']);
                    $organizer->save();
                    Auth::guard('organizers')->login($organizer, $request->boolean('remember'));
                    $request->session()->regenerate();
                    return redirect()->intended(route('admin.dashboard'));
                }
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('organizers')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}

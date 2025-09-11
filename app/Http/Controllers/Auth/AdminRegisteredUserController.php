<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Organizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class AdminRegisteredUserController extends Controller
{
    public function create()
    {
        return view('admin.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required','string','email','max:255','unique:organizers'],
            'password' => ['required','confirmed','min:8'],
        ]);

        $organizer = Organizer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // login dengan guard organizers, bukan web
        Auth::guard('organizers')->login($organizer);

        // trigger email verification notification like user flow
        event(new Registered($organizer));

        // send them to the verification notice page
        return redirect()->route('admin.verification.notice');
    }
}

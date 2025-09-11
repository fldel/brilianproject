<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Organizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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

        return redirect()->route('admin.dashboard');
    }
}

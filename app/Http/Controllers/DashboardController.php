<?php

namespace App\Http\Controllers;

use App\Models\Scholarship;

class DashboardController extends Controller
{
    public function index()
    {
        $scholarships = Scholarship::inRandomOrder()->take(10)->get();
        return view('dashboard', compact('scholarships'));
    }
}

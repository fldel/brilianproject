<?php

namespace App\Http\Controllers;

use App\Models\Scholarship;
use App\Models\Category;
use Illuminate\Http\Request;

class ScholarshipController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        return view('test', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'categories' => 'required|array',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'link' => 'nullable|url',
            'starts_at' => 'nullable|date',
            'ends_at' => 'nullable|date|after_or_equal:starts_at',
        ]);

        // upload image kalau ada
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('scholarships', 'public');
        }

        // simpan scholarship
        $scholarship = Scholarship::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imagePath,
            'link' => $request->link,
            'is_available' => $request->has('is_available'),
            'organizer_id' => auth()->id(), // dari user yang login
            'starts_at' => $request->starts_at,
            'ends_at' => $request->ends_at,
        ]);

        // attach kategori ke pivot
        $scholarship->categories()->attach($request->categories);

        return redirect()->back()->with('success', 'Beasiswa berhasil ditambahkan!');
    }
}

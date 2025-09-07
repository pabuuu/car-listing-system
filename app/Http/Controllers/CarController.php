<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    // Show all cars (for guests & users)
    public function index(Request $request)
    {
        $query = Car::with('user'); // eager load the user relationship

        if ($search = $request->input('search')) {
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        }

        $cars = $query->latest()->get();

        return view('cars.index', compact('cars'));
    }

    // Show create form (only logged-in users)
    public function create()
    {
        return view('cars.create');
    }

    // Store a new car (only logged-in users)
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'fb_link' => 'required|url',
            'image' => 'nullable|image|max:2048',
        ]);

        // Handle image upload
        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('cars', 'public');
        }

        Car::create([
            'user_id' => Auth::id(),
            'title' => $attributes['title'],
            'description' => $attributes['description'] ?? null,
            'fb_link' => $attributes['fb_link'],
            'image_path' => $path,
        ]);

        return redirect()->route('cars.index')->with('success', 'Car added successfully!');
    }

    // Show logged-in user's listings
    public function myListings()
    {
        $cars = Car::where('user_id', auth()->id())->latest()->get();
        return view('cars.my-listings', compact('cars'));
    }

    // Show the edit form for a car
    public function edit(Car $car)
    {
        if ($car->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('cars.edit', compact('car'));
    }

    // Update car details
    public function update(Request $request, Car $car)
    {
        if ($car->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $attributes = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'fb_link' => 'required|url',
            'image' => 'nullable|image|max:2048',
        ]);

        // Handle image replacement
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($car->image_path && \Storage::disk('public')->exists($car->image_path)) {
                \Storage::disk('public')->delete($car->image_path);
            }
            $attributes['image_path'] = $request->file('image')->store('cars', 'public');
        }

        $car->update($attributes);

        return redirect()->route('cars.myListings')->with('success', 'Car updated successfully!');
    }
}

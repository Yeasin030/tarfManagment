<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Booking;
use App\Models\Turf;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $totalBookings = Booking::count();
        $totalRevenue = Booking::where('status', 'completed')->sum('total_price');
        $totalUsers = User::count();
        $totalTurfs = Turf::count();

        $recentBookings = Booking::with(['user', 'turf'])->latest()->take(5)->get();

        return view('admin.dashboard', compact('totalBookings', 'totalRevenue', 'totalUsers', 'totalTurfs', 'recentBookings'));
    }

    public function bookings()
    {
        $bookings = Booking::with(['user', 'turf'])->latest()->paginate(15);
        return view('admin.bookings', compact('bookings'));
    }

    public function updateBookingStatus(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:confirmed,cancelled,completed'
        ]);

        $booking->update(['status' => $request->status]);

        return back()->with('success', 'Booking status updated successfully.');
    }

    public function turfs()
    {
        $turfs = Turf::with('images')->latest()->paginate(15);
        return view('admin.turfs', compact('turfs'));
    }

    public function createTurf()
    {
        return view('admin.turf_create');
    }

    public function storeTurf(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'opening_time' => 'required',
            'closing_time' => 'required',
            'turf_type' => 'required|string|max:50',
            'capacity' => 'nullable|integer|min:1',
            'starting_price' => 'required|numeric|min:0',
            'is_active' => 'boolean'
        ]);

        $validated['slug'] = \Illuminate\Support\Str::slug($validated['name']) . '-' . uniqid();
        $validated['is_active'] = $request->has('is_active');

        Turf::create($validated);

        return redirect()->route('admin.turfs')->with('success', 'Turf created successfully.');
    }

    public function editTurf(Turf $turf)
    {
        return view('admin.turf_edit', compact('turf'));
    }

    public function updateTurf(Request $request, Turf $turf)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'opening_time' => 'required',
            'closing_time' => 'required',
            'turf_type' => 'required|string|max:50',
            'capacity' => 'nullable|integer|min:1',
            'starting_price' => 'required|numeric|min:0',
            'is_active' => 'boolean'
        ]);

        $validated['is_active'] = $request->has('is_active');

        $turf->update($validated);

        return redirect()->route('admin.turfs')->with('success', 'Turf updated successfully.');
    }

    public function deleteTurf(Turf $turf)
    {
        $turf->delete();
        return redirect()->route('admin.turfs')->with('success', 'Turf deleted successfully.');
    }

    public function users()
    {
        $users = User::latest()->paginate(15);
        return view('admin.users', compact('users'));
    }
}

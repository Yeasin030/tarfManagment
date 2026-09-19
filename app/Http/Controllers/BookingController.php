<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Turf;
use App\Models\Booking;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function checkout(Request $request, $slug)
    {
        $turf = Turf::where('slug', $slug)->firstOrFail();
        $date = $request->input('date', date('Y-m-d'));
        $time = $request->input('time', '18:00');

        return view('booking.checkout', compact('turf', 'date', 'time'));
    }

    public function store(Request $request, $slug)
    {
        $turf = Turf::where('slug', $slug)->firstOrFail();
        
        $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required',
        ]);

        $startTime = Carbon::parse($request->time);
        $endTime = $startTime->copy()->addMinutes(90);

        // Check for overlapping bookings
        $isBooked = Booking::where('turf_id', $turf->id)
            ->where('date', $request->date)
            ->where('status', '!=', 'cancelled')
            ->where(function ($query) use ($startTime, $endTime) {
                $query->where('start_time', '<', $endTime->format('H:i:s'))
                      ->where('end_time', '>', $startTime->format('H:i:s'));
            })
            ->exists();

        if ($isBooked) {
            return back()->withErrors(['time' => 'This time slot is already booked. Please choose another time.'])->withInput();
        }

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'turf_id' => $turf->id,
            'date' => $request->date,
            'start_time' => $startTime->format('H:i:s'),
            'end_time' => $endTime->format('H:i:s'),
            'total_price' => $turf->starting_price,
            'status' => 'confirmed',
            'payment_status' => 'pending',
        ]);

        return redirect()->route('booking.success', $booking->id)->with('success', 'Booking confirmed successfully!');
    }

    public function success($id)
    {
        $booking = Booking::with('turf')->where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('booking.success', compact('booking'));
    }
}

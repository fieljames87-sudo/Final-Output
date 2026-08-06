<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    public function index()
    {
        return view('calendar.index');
    }

    public function events(Request $request)
    {
        if (Auth::user()->role === 'admin') {
            $reservations = Reservation::with(['facility', 'user'])->get();
        } else {
            $reservations = Reservation::with('facility')
                ->where('user_id', Auth::id())
                ->get();
        }

        $events = $reservations->map(function ($reservation) {
            return [
                'title' => $reservation->facility->name . ' - ' . $reservation->time,
                'start' => $reservation->date,
                'color' => match ($reservation->status) {
                    'approved' => '#22c55e',
                    'rejected' => '#ef4444',
                    default => '#facc15',
                },
            ];
        });

        return response()->json($events);
    }
}
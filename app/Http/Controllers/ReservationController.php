<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ActivityLog;
use App\Notifications\ReservationStatusNotification;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function approve(Reservation $reservation)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $reservation->update([
            'status' => 'approved'
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Approved Reservation',
            'description' => 'Approved reservation ID ' . $reservation->id,
        ]);

        try {
            $reservation->load(['user', 'facility']);
            $reservation->user->notify(new ReservationStatusNotification($reservation, 'approved'));
        } catch (\Exception $e) {
            return redirect()->route('reservations.index')
                ->with('success', 'Reservation approved, but email notification failed.');
        }

        return redirect()->route('reservations.index')
            ->with('success', 'Reservation approved successfully.');
    }

    public function reject(Reservation $reservation)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $reservation->update([
            'status' => 'rejected'
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Rejected Reservation',
            'description' => 'Rejected reservation ID ' . $reservation->id,
        ]);

        try {
            $reservation->load(['user', 'facility']);
            $reservation->user->notify(new ReservationStatusNotification($reservation, 'rejected'));
        } catch (\Exception $e) {
            return redirect()->route('reservations.index')
                ->with('success', 'Reservation rejected, but email notification failed.');
        }

        return redirect()->route('reservations.index')
            ->with('success', 'Reservation rejected successfully.');
    }
    
    public function index()
    {
        if (Auth::user()->role === 'admin') {
        $reservations = Reservation::with(['facility', 'user'])->get();
        } else {
            $reservations = Reservation::with('facility')
            ->where('user_id', Auth::id())
            ->get();
        }

        return view('reservations.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $facilities = Facility::all();
        return view('reservations.create', compact('facilities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Created Reservation',
            'description' => 'Reserved facility ID ' . $request->facility_id . ' on ' . $request->date . ' at ' . $request->time,
        ]);


        $request->validate([
        'facility_id' => 'required|exists:facilities,id',
        'date' => 'required|date',
        'time' => 'required|string|max:255',
        ]);
        
        $existingReservation = Reservation::where('facility_id', $request->facility_id)
            ->where('date', $request->date)
            ->where('time', $request->time)
            ->whereIn('status', ['pending', 'approved'])
            ->exists();
            
        if ($existingReservation) {
            return back()->withErrors([
                'time' => 'This facility is already reserved for that date and time.'
            ])->withInput();
        }

        Reservation::create([
            'user_id' => Auth::id(),
            'facility_id' => $request->facility_id,
            'date' => $request->date,
            'time' => $request->time,
            'status' => 'pending',
        ]);

        return redirect()->route('reservations.index')
            ->with('success', 'Reservation submitted successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        return view('reservations.show', compact('reservation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        $facilities = Facility::all();
        return view('reservations.edit', compact('reservation', 'facilities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        $request->validate([
            'facility_id' => 'required|exists:facilities,id',
            'date' => 'required|date',
            'time' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);

        $reservation->update([
            'facility_id' => $request->facility_id,
            'date' => $request->date,
            'time' => $request->time,
            'status' => $request->status,
        ]);

        return redirect()->route('reservations.index')
            ->with('success', 'Reservation updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return redirect()->route('reservations.index')
            ->with('success', 'Reservation deleted successfully.');
    }
}
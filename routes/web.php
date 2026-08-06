<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\ReservationController;
use App\Models\Facility;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ActivityLogController;

Route::get('/activity-logs', [ActivityLogController::class, 'index'])
    ->middleware('auth')
    ->name('activity-logs.index');

Route::get('/calendar', [CalendarController::class, 'index'])
    ->middleware('auth')
    ->name('calendar.index');

Route::get('/calendar/events', [CalendarController::class, 'events'])
    ->middleware('auth')
    ->name('calendar.events');

Route::patch('reservations/{reservation}/approve', [ReservationController::class, 'approve'])
    ->middleware('auth')
    ->name('reservations.approve');

Route::patch('reservations/{reservation}/reject', [ReservationController::class, 'reject'])
    ->middleware('auth')
    ->name('reservations.reject');

Route::resource('reservations', ReservationController::class)->middleware('auth');
Route::resource('facilities', FacilityController::class)->middleware('auth');

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    $facilityCount = Facility::count();

    if (Auth::user()->role === 'admin') {
        $reservationCount = Reservation::count();

        $pendingCount = Reservation::where('status', 'pending')->count();

        $approvedCount = Reservation::where('status', 'approved')->count();

        $rejectedCount = Reservation::where('status', 'rejected')->count();
    } else {
        $reservationCount = Reservation::where('user_id', Auth::id())->count();

        $pendingCount = Reservation::where('user_id', Auth::id())
            ->where('status', 'pending')
            ->count();

        $approvedCount = Reservation::where('user_id', Auth::id())
            ->where('status', 'approved')
            ->count();

        $rejectedCount = Reservation::where('user_id', Auth::id())
            ->where('status', 'rejected')
            ->count();
    }

    return view('dashboard', compact(
        'facilityCount',
        'reservationCount',
        'pendingCount',
        'approvedCount',
        'rejectedCount'
    ));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
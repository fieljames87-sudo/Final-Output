@extends('layouts.app-dashboard')

@section('title', 'Reservations')

@section('content')

<h1 class="text-2xl font-bold mb-4">Reservations</h1>

@if(session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<a href="{{ route('reservations.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">
    Add Reservation
</a>

<table class="w-full border mt-4 bg-white">
    <thead>
        <tr class="bg-gray-200">
            @if(Auth::user()->role === 'admin')
                <th class="border p-2">User</th>
            @endif

            <th class="border p-2">Facility</th>
            <th class="border p-2">Date</th>
            <th class="border p-2">Time</th>
            <th class="border p-2">Status</th>

            @if(Auth::user()->role === 'admin')
                <th class="border p-2">Actions</th>
            @endif
        </tr>
    </thead>

    <tbody>
        @forelse($reservations as $reservation)
        <tr>

            @if(Auth::user()->role === 'admin')
                <td class="border p-2">{{ $reservation->user->name }}</td>
            @endif

            <td class="border p-2">{{ $reservation->facility->name }}</td>
            <td class="border p-2">{{ $reservation->date }}</td>
            <td class="border p-2">{{ $reservation->time }}</td>

            <!-- STATUS -->
            <td class="border p-2">
                @if($reservation->status === 'pending')
                    <span class="text-yellow-600 font-semibold">Pending</span>
                @elseif($reservation->status === 'approved')
                    <span class="text-green-600 font-semibold">Approved</span>
                @else
                    <span class="text-red-600 font-semibold">Rejected</span>
                @endif
            </td>

            <!-- ACTIONS -->
            @if(Auth::user()->role === 'admin')
            <td class="border p-2 space-x-2">

                @if($reservation->status === 'pending')

                    <!-- APPROVE -->
                    <form action="{{ route('reservations.approve', $reservation->id) }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <button class="bg-green-500 text-white px-2 py-1 rounded">
                            Approve
                        </button>
                    </form>

                    <!-- REJECT -->
                    <form action="{{ route('reservations.reject', $reservation->id) }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <button class="bg-red-500 text-white px-2 py-1 rounded">
                            Reject
                        </button>
                    </form>

                @endif

            </td>
            @endif

        </tr>
        @empty
        <tr>
            <td colspan="6" class="border p-4 text-center">No reservations yet.</td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection
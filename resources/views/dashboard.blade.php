@extends('layouts.app-dashboard')

@section('title', 'Dashboard')

@section('content')
    <div class="bg-white shadow-md rounded-xl p-6 mb-6">
        <h2 class="text-2xl font-bold text-gray-800">
            Welcome, {{ Auth::user()->name }} 👋
        </h2>
        <p class="text-gray-600 mt-2">
            SLSU Facility Reservation System with Admin Approval and Dashboard Analytics
        </p>

        @if(Auth::user()->role === 'admin')
            <span class="inline-block mt-2 px-3 py-1 text-sm bg-red-100 text-red-700 rounded-full">
                Admin
            </span>
        @else
            <span class="inline-block mt-2 px-3 py-1 text-sm bg-blue-100 text-blue-700 rounded-full">
                User
            </span>
        @endif
    </div>

    <!-- CARDS GRID -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

        <!-- Facilities -->
        <a href="{{ route('facilities.index') }}">
            <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition">
                <h3 class="text-lg font-semibold text-gray-700">Facilities</h3>
                <p class="text-3xl font-bold text-blue-600 mt-2">{{ $facilityCount }}</p>
                <p class="text-sm text-gray-500 mt-1">Total facilities</p>
            </div>
        </a>

        <!-- Reservations -->
        <a href="{{ route('reservations.index') }}">
            <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition">
                <h3 class="text-lg font-semibold text-gray-700">Reservations</h3>
                <p class="text-3xl font-bold text-pink-600 mt-2">{{ $reservationCount }}</p>
                <p class="text-sm text-gray-500 mt-1">Reservations</p>
            </div>
        </a>

        <!-- Pending -->
        <div class="bg-white p-6 rounded-xl shadow-md">
            <h3 class="text-lg font-semibold text-gray-700">Pending Reservations</h3>
            <p class="text-3xl font-bold text-yellow-500 mt-2">{{ $pendingCount }}</p>
            <p class="text-sm text-gray-500 mt-1">Waiting for approval</p>
        </div>

        <!-- Approved -->
        <div class="bg-white p-6 rounded-xl shadow-md">
            <h3 class="text-lg font-semibold text-gray-700">Approved Reservations</h3>
            <p class="text-3xl font-bold text-green-600 mt-2">{{ $approvedCount }}</p>

            @if(Auth::user()->role === 'admin')
                <p class="text-sm text-gray-500 mt-1">All approved reservations</p>
            @else
                <p class="text-sm text-gray-500 mt-1">Your approved reservations</p>
            @endif
        </div>

    </div>

    <!-- CHART -->
    <div class="bg-white p-6 rounded-2xl shadow-md mt-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-700">
                Reservation Status Overview
            </h3>
            <span class="text-sm text-gray-400">Live Summary</span>
        </div>

        <div class="max-w-md mx-auto">
            <canvas id="reservationChart"></canvas>
        </div>
    </div>

   @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('reservationChart');

        if (ctx) {
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Pending', 'Approved', 'Rejected'],
                    datasets: [{
                        data: [
                            {{ $pendingCount }},
                            {{ $approvedCount }},
                            {{ $rejectedCount }}
                        ],
                        backgroundColor: [
                            '#facc15',
                            '#22c55e',
                            '#ef4444'
                        ],
                        borderColor: '#ffffff',
                        borderWidth: 3,
                        hoverOffset: 12
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    cutout: '55%',
                    animation: {
                        animateRotate: true,
                        animateScale: true,
                        duration: 1400,
                        easing: 'easeOutQuart'
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                boxWidth: 18,
                                boxHeight: 18,
                                font: {
                                    size: 13,
                                    weight: '600'
                                },
                                color: '#374151'
                            }
                        },
                        tooltip: {
                            backgroundColor: '#111827',
                            titleColor: '#ffffff',
                            bodyColor: '#ffffff',
                            padding: 12,
                            cornerRadius: 10,
                            displayColors: true
                        }
                    }
                }
            });
        }
    });
</script>
@endpush
@endsection
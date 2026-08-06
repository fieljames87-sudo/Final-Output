@extends('layouts.app-dashboard')

@section('title', 'Calendar')

@section('content')
    <div class="bg-white p-6 rounded-xl shadow-md">
        <h2 class="text-2xl font-bold mb-4">Reservation Calendar</h2>

        <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.19/index.global.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.19/index.global.min.js"></script>

        <div id="calendar"></div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const calendarEl = document.getElementById('calendar');

            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: '{{ route('calendar.events') }}',
                height: 'auto'
            });

            calendar.render();
        });
    </script>
@endsection
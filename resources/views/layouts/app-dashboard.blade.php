<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- Header -->
    <header class="bg-blue-700 text-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            
            <!-- Logo + Title -->
            <div class="flex items-center gap-3">
                @if(Auth::user()->profile_image)
                    <img src="{{ asset('storage/' . Auth::user()->profile_image) }}"
                        alt="Profile"
                        class="w-12 h-12 rounded-full object-cover border-2 border-white">
                @else
                    <img src="{{ asset('image.png') }}"
                        alt="Logo"
                        class="w-12 h-12 rounded-full object-cover border-2 border-white">
                @endif

                <div>
                    <h1 class="text-lg font-bold">SLSU Facility Reservation System</h1>
                    <p class="text-xs text-blue-100">{{ Auth::user()->name }}</p>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex items-center gap-3">
                <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-lg hover:bg-blue-600">
                    Dashboard
                </a>

                @auth
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('facilities.index') }}" class="px-4 py-2 rounded-lg hover:bg-blue-600">
                            Facilities
                        </a>
                    @endif
                @endauth

                <a href="{{ route('reservations.index') }}" class="px-4 py-2 rounded-lg hover:bg-blue-600">
                    Reservations
                </a>

                <a href="{{ route('calendar.index') }}" class="px-4 py-2 rounded-lg hover:bg-blue-600">
                    Calendar
                </a>

                <a href="{{ route('activity-logs.index') }}" class="px-4 py-2 rounded-lg hover:bg-blue-600">
                    Activity Logs
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded-lg">
                        Logout
                    </button>
                </form>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
        <main class="max-w-7xl mx-auto p-6 mt-4">
            @yield('content')
        </main>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@stack('scripts')
</body>
</html>
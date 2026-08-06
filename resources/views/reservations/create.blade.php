@extends('layouts.app-dashboard')

@section('title', 'Create Reservation')

@section('content')
    <div class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow-lg">
        <h1 class="text-2xl font-bold mb-4">Make Reservation</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('reservations.store') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block mb-1 font-medium">Facility</label>
                <select name="facility_id" class="w-full border p-2 rounded">
                    <option value="">Select Facility</option>
                    @foreach($facilities as $facility)
                        <option value="{{ $facility->id }}" {{ old('facility_id') == $facility->id ? 'selected' : '' }}>
                            {{ $facility->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-1 font-medium">Date</label>
                <input type="date" name="date" value="{{ old('date') }}" class="w-full border p-2 rounded">
            </div>

            <div>
                <label class="block mb-1 font-medium">Time</label>

                <!-- Dropdown -->
                <select id="timeSelect" class="w-full border p-2 rounded mb-2">
                    <option value="">Select Time</option>
                    <option value="08:00 AM">08:00 AM</option>
                    <option value="09:00 AM">09:00 AM</option>
                    <option value="10:00 AM">10:00 AM</option>
                    <option value="11:00 AM">11:00 AM</option>
                    <option value="01:00 PM">01:00 PM</option>
                    <option value="02:00 PM">02:00 PM</option>
                    <option value="03:00 PM">03:00 PM</option>
                    <option value="04:00 PM">04:00 PM</option>
                </select>

                <!-- Manual Input -->
                <input 
                    type="text" 
                    name="time" 
                    id="timeInput"
                    value="{{ old('time') }}"
                    placeholder="Or type time manually (e.g. 10:30 AM)"
                    class="w-full border p-2 rounded"
                >
                </div>

                <script>
                    document.getElementById('timeSelect').addEventListener('change', function() {
                        document.getElementById('timeInput').value = this.value;
                    });
                </script>

            <div class="flex gap-2">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Reserve
                </button>

                <a href="{{ route('reservations.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection
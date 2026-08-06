@extends('layouts.app-dashboard')

@section('title', 'Facilities')

@section('content')

<div class="max-w-6xl mx-auto px-4 py-6">

    <div class="bg-white p-6 rounded-2xl shadow-lg mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <div>
            <h1 class="text-3xl font-bold text-gray-900">
                Available Facilities
            </h1>

            <p class="text-gray-500 mt-1">
                Manage and view all facilities available for reservation.
            </p>
        </div>

        <a
            href="{{ route('facilities.create') }}"
            class="inline-block bg-blue-600 text-white px-5 py-3 rounded-xl font-semibold hover:bg-blue-700 transition text-center"
        >
            + Add Facility
        </a>

    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded-xl mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        @forelse($facilities as $facility)

            <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:-translate-y-1 transition duration-300">

                @if($facility->image)
                    <img
                        src="{{ asset('storage/' . $facility->image) }}"
                        alt="{{ $facility->name }}"
                        class="w-full h-56 object-cover"
                    >
                @else
                    <div class="w-full h-56 bg-gray-200 flex items-center justify-center text-gray-500">
                        No Facility Image
                    </div>
                @endif

                <div class="p-6">

                    <h2 class="text-2xl font-bold text-gray-900 mb-2">
                        {{ $facility->name }}
                    </h2>

                    <p class="text-gray-600 mb-4 min-h-[48px]">
                        {{ $facility->description }}
                    </p>

                    <p class="text-gray-800 mb-4">
                        Capacity:
                        <span class="font-bold">
                            {{ $facility->capacity }}
                        </span>
                    </p>

                    @if(isset($facility->status))
                        <span
                            class="
                                inline-block px-4 py-2 rounded-full text-sm font-semibold capitalize
                                {{ $facility->status === 'available'
                                    ? 'bg-green-100 text-green-700'
                                    : ($facility->status === 'unavailable'
                                        ? 'bg-red-100 text-red-700'
                                        : 'bg-yellow-100 text-yellow-700')
                                }}
                            "
                        >
                            {{ str_replace('-', ' ', $facility->status) }}
                        </span>
                    @endif

                    <div class="flex flex-wrap gap-2 mt-5">

                        <a
                            href="{{ route('facilities.show', $facility->id) }}"
                            class="bg-green-100 text-green-700 px-4 py-2 rounded-lg font-semibold hover:bg-green-200 transition"
                        >
                            View
                        </a>

                        <a
                            href="{{ route('facilities.edit', $facility->id) }}"
                            class="bg-blue-100 text-blue-700 px-4 py-2 rounded-lg font-semibold hover:bg-blue-200 transition"
                        >
                            Edit
                        </a>

                        <form
                            action="{{ route('facilities.destroy', $facility->id) }}"
                            method="POST"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="bg-red-100 text-red-700 px-4 py-2 rounded-lg font-semibold hover:bg-red-200 transition"
                                onclick="return confirm('Delete this facility?')"
                            >
                                Delete
                            </button>
                        </form>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-span-full bg-white rounded-2xl shadow-lg p-12 text-center">

                <h2 class="text-2xl font-bold text-gray-800 mb-2">
                    No Facilities Found
                </h2>

                <p class="text-gray-500">
                    Add your first facility to display it here.
                </p>

            </div>

        @endforelse

    </div>

</div>

@endsection
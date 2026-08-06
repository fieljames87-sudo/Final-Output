@extends('layouts.app-dashboard')

@section('title', 'View Facility')

@section('content')

<div class="max-w-5xl mx-auto px-4 py-6">

    <div class="bg-white rounded-2xl overflow-hidden shadow-lg">

        @if($facility->image)
            <img
                src="{{ asset('storage/' . $facility->image) }}"
                alt="{{ $facility->name }}"
                class="w-full h-96 object-cover"
            >
        @else
            <div class="w-full h-96 bg-gray-200 flex items-center justify-center text-gray-500 text-lg">
                No Facility Image
            </div>
        @endif

        <div class="p-8">

            <h1 class="text-4xl font-bold text-gray-900 mb-3">
                {{ $facility->name }}
            </h1>

            <p class="text-gray-600 text-lg leading-relaxed mb-6">
                {{ $facility->description ?: 'No description available.' }}
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-7">

                <div class="bg-gray-50 p-5 rounded-xl">
                    <p class="text-sm text-gray-500 mb-2">
                        Capacity
                    </p>

                    <p class="text-2xl font-bold text-gray-900">
                        {{ $facility->capacity ?? 'Not specified' }}
                    </p>
                </div>

                @if(isset($facility->status))
                    <div class="bg-gray-50 p-5 rounded-xl">
                        <p class="text-sm text-gray-500 mb-2">
                            Status
                        </p>

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
                    </div>
                @endif

            </div>

            <div class="flex flex-wrap gap-3">

                <a
                    href="{{ route('facilities.index') }}"
                    class="bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-700 transition"
                >
                    Back
                </a>

                @if(auth()->user()->role === 'admin')
                    <a
                        href="{{ route('facilities.edit', $facility->id) }}"
                        class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition"
                    >
                        Edit Facility
                    </a>
                @endif

            </div>

        </div>

    </div>

</div>

@endsection
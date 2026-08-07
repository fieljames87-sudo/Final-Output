@extends('layouts.app-dashboard')

@section('title', 'Add Facility')

@section('content')

<div class="max-w-2xl mx-auto bg-white p-8 rounded-2xl shadow-lg">

    <h1 class="text-3xl font-bold mb-6">
        Add Facility
    </h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded-xl mb-5">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        action="{{ route('facilities.store') }}"
        method="POST"
        enctype="multipart/form-data"
        class="space-y-5"
    >
        @csrf

        {{-- Facility Name --}}
        <div>
            <label class="block mb-2 font-semibold">
                Facility Name
            </label>

            <input
                type="text"
                name="name"
                value="{{ old('name') }}"
                class="w-full border border-gray-300 rounded-lg p-3"
                placeholder="Enter facility name"
                required
            >
        </div>

        {{-- Description --}}
        <div>
            <label class="block mb-2 font-semibold">
                Description
            </label>

            <textarea
                name="description"
                rows="4"
                class="w-full border border-gray-300 rounded-lg p-3"
                placeholder="Enter facility description"
            >{{ old('description') }}</textarea>
        </div>

        {{-- Capacity --}}
        <div>
            <label class="block mb-2 font-semibold">
                Capacity
            </label>

            <input
                type="number"
                name="capacity"
                value="{{ old('capacity') }}"
                min="1"
                class="w-full border border-gray-300 rounded-lg p-3"
                placeholder="Enter maximum capacity"
            >
        </div>

        {{-- Status --}}
        <div>
            <label class="block mb-2 font-semibold">
                Status
            </label>

            <select
                name="status"
                class="w-full border border-gray-300 rounded-lg p-3"
                required
            >
                <option value="">-- Select Status --</option>

                <option
                    value="available"
                    {{ old('status') == 'available' ? 'selected' : '' }}
                >
                    Available
                </option>

                <option
                    value="unavailable"
                    {{ old('status') == 'unavailable' ? 'selected' : '' }}
                >
                    Unavailable
                </option>

                <option
                    value="under-maintenance"
                    {{ old('status') == 'under-maintenance' ? 'selected' : '' }}
                >
                    Under Maintenance
                </option>

            </select>
        </div>

        {{-- Facility Image --}}
        <div>
            <label class="block mb-2 font-semibold">
                Facility Image
            </label>

            <input
                type="file"
                name="image"
                accept="image/jpeg,image/png,image/webp"
                class="w-full border border-gray-300 rounded-lg p-3"
            >

            <p class="text-sm text-gray-500 mt-2">
                Accepted formats: JPG, JPEG, PNG, and WebP (Maximum: 5MB).
            </p>
        </div>

        {{-- Buttons --}}
        <div class="flex gap-3">

            <button
                type="submit"
                class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-semibold transition"
            >
                Save Facility
            </button>

            <a
                href="{{ route('facilities.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold transition"
            >
                Cancel
            </a>

        </div>

    </form>

</div>

@endsection
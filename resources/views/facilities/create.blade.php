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

        <div>
            <label class="block mb-2 font-semibold">
                Facility Name
            </label>

            <input
                type="text"
                name="name"
                value="{{ old('name') }}"
                class="w-full border border-gray-300 p-3 rounded-lg"
                required
            >
        </div>

        <div>
            <label class="block mb-2 font-semibold">
                Description
            </label>

            <textarea
                name="description"
                rows="4"
                class="w-full border border-gray-300 p-3 rounded-lg"
            >{{ old('description') }}</textarea>
        </div>

        <div>
            <label class="block mb-2 font-semibold">
                Capacity
            </label>

            <input
                type="number"
                name="capacity"
                value="{{ old('capacity') }}"
                min="1"
                class="w-full border border-gray-300 p-3 rounded-lg"
            >
        </div>

        <div>
            <label class="block mb-2 font-semibold">
                Facility Image
            </label>

            <input
                type="file"
                name="image"
                accept="image/*"
                class="w-full border border-gray-300 p-3 rounded-lg"
            >

            <p class="text-sm text-gray-500 mt-2">
                Accepted formats: JPG, JPEG, PNG, and WebP.
            </p>
        </div>

        <div class="flex gap-3">

            <button
                type="submit"
                class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 font-semibold"
            >
                Save Facility
            </button>

            <a
                href="{{ route('facilities.index') }}"
                class="bg-gray-500 text-white px-6 py-3 rounded-lg hover:bg-gray-600 font-semibold"
            >
                Cancel
            </a>

        </div>

    </form>

</div>
@endsection
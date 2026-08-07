@extends('layouts.app-dashboard')

@section('title', 'Edit Facility')

@section('content')

<div class="max-w-2xl mx-auto bg-white p-8 rounded-2xl shadow-lg">

    <h1 class="text-3xl font-bold mb-6">
        Edit Facility
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
        action="{{ route('facilities.update', $facility->id) }}"
        method="POST"
        enctype="multipart/form-data"
        class="space-y-5"
    >

        @csrf
        @method('PUT')

        <div>
            <label class="block mb-2 font-semibold">
                Facility Name
            </label>

            <input
                type="text"
                name="name"
                value="{{ old('name', $facility->name) }}"
                class="w-full border rounded-lg p-3"
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
                class="w-full border rounded-lg p-3"
            >{{ old('description', $facility->description) }}</textarea>
        </div>

        <div>
            <label class="block mb-2 font-semibold">
                Capacity
            </label>

            <input
                type="number"
                name="capacity"
                value="{{ old('capacity', $facility->capacity) }}"
                min="1"
                class="w-full border rounded-lg p-3"
            >
        </div>

        <div>
            <label class="block mb-2 font-semibold">
                Status
            </label>

            <select
                name="status"
                class="w-full border rounded-lg p-3"
                required
            >
                <option
                    value="available"
                    {{ old('status', $facility->status) === 'available' ? 'selected' : '' }}
                >
                    Available
                </option>

                <option
                    value="unavailable"
                    {{ old('status', $facility->status) === 'unavailable' ? 'selected' : '' }}
                >
                    Unavailable
                </option>

                <option
                    value="under-maintenance"
                    {{ old('status', $facility->status) === 'under-maintenance' ? 'selected' : '' }}
                >
                    Under Maintenance
                </option>
            </select>
        </div>

        <div>
            <label class="block mb-2 font-semibold">
                Current Facility Image
            </label>

            @if($facility->image)

                <img
                    src="{{ asset('storage/' . $facility->image) }}"
                    alt="{{ $facility->name }}"
                    class="w-full h-64 object-cover rounded-xl mb-4 border"
                >

            @else

                <div class="bg-gray-100 rounded-xl h-64 flex items-center justify-center text-gray-500 mb-4">
                    No Image Uploaded
                </div>

            @endif
        </div>

        <div>
            <label class="block mb-2 font-semibold">
                Replace Image
            </label>

            <input
                type="file"
                name="image"
                accept="image/jpeg,image/png,image/webp"
                class="w-full border rounded-lg p-3"
            >

            <p class="text-sm text-gray-500 mt-2">
                Leave blank to keep the current image.
            </p>
        </div>

        <div class="flex gap-3">

            <button
                type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold"
            >
                Update Facility
            </button>

            <a
                href="{{ route('facilities.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold"
            >
                Cancel
            </a>

        </div>

    </form>

</div>

@endsection
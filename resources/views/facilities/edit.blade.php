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

        {{-- Facility Name --}}
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

        {{-- Description --}}
        <div>
            <label class="block mb-2 font-semibold">
                Description
            </label>

            <textarea
                name="description"
                rows="4"
                class="w-full border rounded-lg p-3"
                required
            >{{ old('description', $facility->description) }}</textarea>
        </div>

        {{-- Capacity --}}
        <div>
            <label class="block mb-2 font-semibold">
                Capacity
            </label>

            <input
                type="number"
                name="capacity"
                value="{{ old('capacity', $facility->capacity) }}"
                class="w-full border rounded-lg p-3"
                required
            >
        </div>

        {{-- Current Image --}}
        <div>

            <label class="block mb-2 font-semibold">
                Current Facility Image
            </label>

            @if($facility->image)

                <img
                    src="{{ asset('storage/'.$facility->image) }}"
                    class="w-full h-64 object-cover rounded-xl mb-4 border"
                >

            @else

                <div class="bg-gray-100 rounded-xl h-64 flex items-center justify-center text-gray-500 mb-4">
                    No Image Uploaded
                </div>

            @endif

        </div>

        {{-- Upload New Image --}}
        <div>

            <label class="block mb-2 font-semibold">
                Replace Image
            </label>

            <input
                type="file"
                name="image"
                accept="image/*"
                class="w-full border rounded-lg p-3"
            >

            <small class="text-gray-500">
                Leave blank if you don't want to change the current image.
            </small>

        </div>

        {{-- Buttons --}}
        <div class="flex gap-3">

            <button
                type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg"
            >
                Update Facility
            </button>

            <a
                href="{{ route('facilities.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg"
            >
                Cancel
            </a>

        </div>

    </form>

</div>
@endsection

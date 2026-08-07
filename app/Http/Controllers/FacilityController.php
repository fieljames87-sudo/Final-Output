<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FacilityController extends Controller
{
    public function index()
    {
        $facilities = Facility::latest()->get();

        return view('facilities.index', compact('facilities'));
    }

    public function create()
    {
        $this->ensureAdmin();

        return view('facilities.create');
    }

    public function store(Request $request)
    {
        $this->ensureAdmin();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'capacity' => ['nullable', 'integer', 'min:1'],
            'status' => [
                'required',
                'in:available,unavailable,under-maintenance',
            ],
            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request
                ->file('image')
                ->store('facilities', 'public');
        }

        Facility::create($validated);

        return redirect()
            ->route('facilities.index')
            ->with('success', 'Facility added successfully.');
    }

    public function show(Facility $facility)
    {
        return view('facilities.show', compact('facility'));
    }

    public function edit(Facility $facility)
    {
        $this->ensureAdmin();

        return view('facilities.edit', compact('facility'));
    }

    public function update(Request $request, Facility $facility)
    {
        $this->ensureAdmin();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'capacity' => ['nullable', 'integer', 'min:1'],
            'status' => [
                'required',
                'in:available,unavailable,under-maintenance',
            ],
            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],
        ]);

        if ($request->hasFile('image')) {

            // Delete the old picture
            if ($facility->image) {
                Storage::disk('public')->delete($facility->image);
            }

            // Save the new picture
            $validated['image'] = $request
                ->file('image')
                ->store('facilities', 'public');
        }

    $facility->update($validated);

    return redirect()
        ->route('facilities.index')
        ->with('success', 'Facility updated successfully.');
}

    public function destroy(Facility $facility)
    {
        $this->ensureAdmin();

        if ($facility->image) {
            Storage::disk('public')->delete($facility->image);
        }

        $facility->delete();

        return redirect()
            ->route('facilities.index')
            ->with('success', 'Facility deleted successfully.');
    }

    private function ensureAdmin(): void
    {
        abort_unless(
            Auth::check() && Auth::user()->role === 'admin',
            403
        );
    }
}
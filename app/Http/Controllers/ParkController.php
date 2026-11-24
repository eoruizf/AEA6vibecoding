<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\StoresFiles;
use App\Models\Park;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class ParkController extends Controller
{
    use StoresFiles;

    public function index(Request $request): View
    {
        $parks = Park::query()
            ->when($request->search, fn ($query, $search) => $query
                ->where('name', 'like', "%{$search}%"))
            ->when($request->city, fn ($query, $city) => $query
                ->where('city', 'like', "%{$city}%"))
            ->when($request->dog_zone === 'yes', fn ($query) => $query
                ->where('has_dog_zone', true))
            ->when($request->dog_zone === 'no', fn ($query) => $query
                ->where('has_dog_zone', false))
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view('parks.index', compact('parks'));
    }

    public function show(Park $park): View
    {
        Gate::authorize('view', $park);

        return view('parks.show', compact('park'));
    }

    public function create(): View
    {
        Gate::authorize('create', Park::class);

        return view('parks.create');
    }

    public function store(Request $request): RedirectResponse
    {
        Gate::authorize('create', Park::class);

        $data = $this->validated($request);
        unset($data['image']);

        $data['has_dog_zone'] = $request->boolean('has_dog_zone');

        if ($request->hasFile('image')) {
            $data['image'] = $this->storeFile($request, 'image', 'parks');
        }

        $park = Park::create($data);

        return redirect()->route('parks.show', $park)
            ->with('success', 'Parque creado.');
    }

    public function edit(Park $park): View
    {
        Gate::authorize('update', $park);

        return view('parks.edit', compact('park'));
    }

    public function update(Request $request, Park $park): RedirectResponse
    {
        Gate::authorize('update', $park);

        $data = $this->validated($request);
        unset($data['image']);

        $data['has_dog_zone'] = $request->boolean('has_dog_zone');

        if ($request->hasFile('image')) {
            $this->deleteFiles($park->image);
            $data['image'] = $this->storeFile($request, 'image', 'parks');
        }

        $park->update($data);

        return redirect()->route('parks.show', $park)
            ->with('success', 'Parque actualizado.');
    }

    public function destroy(Park $park): RedirectResponse
    {
        Gate::authorize('delete', $park);

        $this->deleteFiles($park->image);
        $park->delete();

        return redirect()->route('parks.index')
            ->with('success', 'Parque eliminado.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:5000'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:120'],
            'latitude' => ['nullable', 'required_with:longitude', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'required_with:latitude', 'numeric', 'between:-180,180'],
            'phone' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255'],
            'website' => ['nullable', 'url', 'max:255'],
            'opening_hours' => ['nullable', 'string', 'max:2000'],
            'services' => ['nullable', 'array'],
            'services.*' => ['string', 'max:100'],
            'has_dog_zone' => ['nullable', 'boolean'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);
    }
}

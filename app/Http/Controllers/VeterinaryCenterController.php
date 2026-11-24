<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\StoresFiles;
use App\Models\VeterinaryCenter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class VeterinaryCenterController extends Controller
{
    use StoresFiles;

    public const SERVICES = [
        'Urgencias',
        'Vacunación',
        'Cirugía',
        'Diagnóstico',
        'Peluquería',
        'Microchip',
        'Hospitalización',
    ];

    public function index(Request $request): View
    {
        $centers = VeterinaryCenter::query()
            ->when($request->search, fn ($query, $search) => $query
                ->where('name', 'like', "%{$search}%"))
            ->when($request->city, fn ($query, $city) => $query
                ->where('city', 'like', "%{$city}%"))
            ->when(in_array($request->service, self::SERVICES, true), fn ($query) => $query
                ->whereJsonContains('services', $request->service))
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view('veterinary-centers.index', compact('centers'));
    }

    public function show(VeterinaryCenter $veterinaryCenter): View
    {
        Gate::authorize('view', $veterinaryCenter);

        return view('veterinary-centers.show', compact('veterinaryCenter'));
    }

    public function create(): View
    {
        Gate::authorize('create', VeterinaryCenter::class);

        return view('veterinary-centers.create');
    }

    public function store(Request $request): RedirectResponse
    {
        Gate::authorize('create', VeterinaryCenter::class);

        $data = $this->validated($request);
        unset($data['image']);

        if ($request->hasFile('image')) {
            $data['image'] = $this->storeFile($request, 'image', 'veterinary-centers');
        }

        $center = VeterinaryCenter::create($data);

        return redirect()->route('veterinary-centers.show', $center)
            ->with('success', 'Centro veterinario creado.');
    }

    public function edit(VeterinaryCenter $veterinaryCenter): View
    {
        Gate::authorize('update', $veterinaryCenter);

        return view('veterinary-centers.edit', compact('veterinaryCenter'));
    }

    public function update(Request $request, VeterinaryCenter $veterinaryCenter): RedirectResponse
    {
        Gate::authorize('update', $veterinaryCenter);

        $data = $this->validated($request);
        unset($data['image']);

        if ($request->hasFile('image')) {
            $this->deleteFiles($veterinaryCenter->image);
            $data['image'] = $this->storeFile($request, 'image', 'veterinary-centers');
        }

        $veterinaryCenter->update($data);

        return redirect()->route('veterinary-centers.show', $veterinaryCenter)
            ->with('success', 'Centro veterinario actualizado.');
    }

    public function destroy(VeterinaryCenter $veterinaryCenter): RedirectResponse
    {
        Gate::authorize('delete', $veterinaryCenter);

        $this->deleteFiles($veterinaryCenter->image);
        $veterinaryCenter->delete();

        return redirect()->route('veterinary-centers.index')
            ->with('success', 'Centro veterinario eliminado.');
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
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);
    }
}

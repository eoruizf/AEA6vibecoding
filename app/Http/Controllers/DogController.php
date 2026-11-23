<?php

namespace App\Http\Controllers;

use App\Models\Dog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class DogController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        $dogs = Dog::query()
            ->with('user')
            ->when(! $user->isAdmin(), fn ($q) => $q->where('user_id', $user->id))
            ->latest()
            ->paginate(9);

        return view('dogs.index', compact('dogs'));
    }

    public function create(): View
    {
        return view('dogs.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['user_id'] = $request->user()->id; // dima mn session, machi mn form
        $data['photos']  = $this->storePhotos($request);
        $data['is_neutered'] = $request->boolean('is_neutered');

        Dog::create($data);

        return redirect()->route('dogs.index')->with('success', 'Perro añadido.');
    }

    public function show(Dog $dog): View
    {
        Gate::authorize('view', $dog);

        return view('dogs.show', compact('dog'));
    }

    public function edit(Dog $dog): View
    {
        Gate::authorize('update', $dog);

        return view('dogs.edit', compact('dog'));
    }

    public function update(Request $request, Dog $dog): RedirectResponse
    {
        Gate::authorize('update', $dog);

        $data = $this->validated($request, $dog);
        $data['is_neutered'] = $request->boolean('is_neutered');

        $photos = $dog->photos ?? [];

        // Msa7 tsawer li t7eddo
        foreach ((array) $request->input('remove_photos', []) as $path) {
            if (in_array($path, $photos, true)) {
                Storage::disk('public')->delete($path);
                $photos = array_values(array_diff($photos, [$path]));
            }
        }

        $data['photos'] = array_merge($photos, $this->storePhotos($request));

        $dog->update($data);

        return redirect()->route('dogs.show', $dog)->with('success', 'Perro actualizado.');
    }

    public function destroy(Dog $dog): RedirectResponse
    {
        Gate::authorize('delete', $dog);

        foreach ($dog->photos ?? [] as $path) {
            Storage::disk('public')->delete($path);
        }

        $dog->delete();

        return redirect()->route('dogs.index')->with('success', 'Perro eliminado.');
    }

    private function validated(Request $request, ?Dog $dog = null): array
    {
        return $request->validate([
            'name'             => ['required', 'string', 'max:255'],
            'description'      => ['nullable', 'string', 'max:2000'],
            'date_of_birth'    => ['nullable', 'date', 'before_or_equal:today'],
            'breed'            => ['nullable', 'string', 'max:255'],
            'sex'              => ['required', Rule::in(Dog::SEXES)],
            'weight'           => ['nullable', 'numeric', 'min:0', 'max:200'],
            'color'            => ['nullable', 'string', 'max:100'],
            'microchip_number' => ['nullable', 'string', 'max:50', Rule::unique('dogs')->ignore($dog?->id)],
            'photos'           => ['nullable', 'array', 'max:5'],
            'photos.*'         => ['image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);
    }

    private function storePhotos(Request $request): array
    {
        $paths = [];
        foreach ($request->file('photos', []) as $file) {
            $paths[] = $file->store('dogs', 'public');
        }

        return $paths;
    }
}
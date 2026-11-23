<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\StoresFiles;
use App\Models\AdoptionDog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AdoptionDogController extends Controller
{
    use StoresFiles;

    private const FLAGS = ['is_neutered', 'is_vaccinated', 'is_microchipped', 'good_with_kids', 'good_with_dogs'];

    public function index(Request $request): View
    {
        $status = $request->input('status', 'available');

        $dogs = AdoptionDog::query()
            ->with('user')
            ->withInteractions($request->user())
            ->when($request->search, fn ($q, $s) => $q->where(fn ($q) => $q
                ->where('name', 'like', "%{$s}%")
                ->orWhere('breed', 'like', "%{$s}%")))
            ->when($request->city, fn ($q, $c) => $q->where('city', 'like', "%{$c}%"))
            ->when($request->sex, fn ($q, $v) => $q->where('sex', $v))
            ->when($request->size, fn ($q, $v) => $q->where('size', $v))
            ->when($status !== 'all', fn ($q) => $q->where('status', $status))
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view('adoption-dogs.index', compact('dogs', 'status'));
    }

    public function show(AdoptionDog $adoptionDog): View
    {
        $adoptionDog->load('user');

        return view('adoption-dogs.show', ['dog' => $adoptionDog]);
    }

    public function create(): View
    {
        return view('adoption-dogs.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['user_id'] = $request->user()->id;
        $data['photos']  = $this->storeFiles($request, 'photos', 'adoptions');

        foreach (self::FLAGS as $flag) {
            $data[$flag] = $request->boolean($flag);
        }

        $dog = AdoptionDog::create($data);

        return redirect()->route('adoption-dogs.show', $dog)->with('success', 'Perro publicado para adopción.');
    }

    public function edit(AdoptionDog $adoptionDog): View
    {
        Gate::authorize('update', $adoptionDog);

        return view('adoption-dogs.edit', ['dog' => $adoptionDog]);
    }

    public function update(Request $request, AdoptionDog $adoptionDog): RedirectResponse
    {
        Gate::authorize('update', $adoptionDog);

        $data = $this->validated($request);

        foreach (self::FLAGS as $flag) {
            $data[$flag] = $request->boolean($flag);
        }

        $photos = $adoptionDog->photos ?? [];
        foreach ((array) $request->input('remove_photos', []) as $path) {
            if (in_array($path, $photos, true)) {
                $this->deleteFiles($path);
                $photos = array_values(array_diff($photos, [$path]));
            }
        }
        $data['photos'] = array_merge($photos, $this->storeFiles($request, 'photos', 'adoptions'));

        $adoptionDog->update($data);

        return redirect()->route('adoption-dogs.show', $adoptionDog)->with('success', 'Anuncio actualizado.');
    }

    public function destroy(AdoptionDog $adoptionDog): RedirectResponse
    {
        Gate::authorize('delete', $adoptionDog);

        $this->deleteFiles($adoptionDog->photos);
        $adoptionDog->delete();

        return redirect()->route('adoption-dogs.index')->with('success', 'Anuncio eliminado.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name'                  => ['required', 'string', 'max:255'],
            'description'           => ['nullable', 'string', 'max:3000'],
            'date_of_birth'         => ['nullable', 'date', 'before_or_equal:today'],
            'breed'                 => ['nullable', 'string', 'max:255'],
            'sex'                   => ['required', Rule::in(array_keys(AdoptionDog::SEXES))],
            'size'                  => ['nullable', Rule::in(array_keys(AdoptionDog::SIZES))],
            'weight'                => ['nullable', 'numeric', 'min:0', 'max:200'],
            'color'                 => ['nullable', 'string', 'max:100'],
            'city'                  => ['nullable', 'string', 'max:120'],
            'adoption_requirements' => ['nullable', 'string', 'max:2000'],
            'status'                => ['required', Rule::in(array_keys(AdoptionDog::STATUSES))],
            'photos'                => ['nullable', 'array', 'max:6'],
            'photos.*'              => ['image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);
    }
}
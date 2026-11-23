<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\StoresFiles;
use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class EventController extends Controller
{
    use StoresFiles;

    public function index(Request $request): View
    {
        $when = $request->input('when', 'upcoming') === 'past' ? 'past' : 'upcoming';

        $events = Event::query()
            ->with('user')
            ->withInteractions($request->user())
            ->when($request->search, fn ($q, $s) => $q->where(fn ($q) => $q
                ->where('title', 'like', "%{$s}%")
                ->orWhere('location_name', 'like', "%{$s}%")))
            ->when($request->city, fn ($q, $c) => $q->where('city', 'like', "%{$c}%"))
            ->when($when === 'upcoming',
                fn ($q) => $q->upcoming()->orderBy('starts_at'),
                fn ($q) => $q->past()->orderByDesc('starts_at'))
            ->paginate(9)
            ->withQueryString();

        return view('events.index', compact('events', 'when'));
    }

    public function show(Event $event): View
    {
        $event->load('user');

        return view('events.show', compact('event'));
    }

    public function create(): View
    {
        return view('events.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['user_id'] = $request->user()->id;
        $data['status']  = 'published';
        unset($data['image']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('events', 'public');
        }

        $event = Event::create($data);

        return redirect()->route('events.show', $event)->with('success', 'Evento creado.');
    }

    public function edit(Event $event): View
    {
        Gate::authorize('update', $event);

        return view('events.edit', compact('event'));
    }

    public function update(Request $request, Event $event): RedirectResponse
    {
        Gate::authorize('update', $event);

        $data = $this->validated($request, $event);
        unset($data['image']);

        if ($request->hasFile('image')) {
            $this->deleteFiles($event->image);
            $data['image'] = $request->file('image')->store('events', 'public');
        } elseif ($request->boolean('remove_image')) {
            $this->deleteFiles($event->image);
            $data['image'] = null;
        }

        $event->update($data);

        return redirect()->route('events.show', $event)->with('success', 'Evento actualizado.');
    }

    public function destroy(Event $event): RedirectResponse
    {
        Gate::authorize('delete', $event);

        $this->deleteFiles($event->image);
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Evento eliminado.');
    }

    private function validated(Request $request, ?Event $event = null): array
    {
        return $request->validate([
            'title'         => ['required', 'string', 'max:255'],
            'description'   => ['nullable', 'string', 'max:5000'],
            'starts_at'     => $event ? ['required', 'date'] : ['required', 'date', 'after:now'],
            'ends_at'       => ['nullable', 'date', 'after:starts_at'],
            'location_name' => ['nullable', 'string', 'max:255'],
            'address'       => ['nullable', 'string', 'max:255'],
            'city'          => ['nullable', 'string', 'max:120'],
            'latitude'      => ['nullable', 'numeric', 'between:-90,90'],
            'longitude'     => ['nullable', 'numeric', 'between:-180,180'],
            'price'         => ['nullable', 'numeric', 'min:0', 'max:99999'],
            'max_attendees' => ['nullable', 'integer', 'min:1'],
            'status'        => ['sometimes', Rule::in(array_keys(Event::STATUSES))],
            'image'         => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
        ]);
    }
}
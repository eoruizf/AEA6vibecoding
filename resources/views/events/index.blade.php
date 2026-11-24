
@extends('layouts.app')

@section('title', 'Esdeveniments')

@section('content')
    <div class="card events-page">

        <div class="events-header">
            <h2>Esdeveniments</h2>

            @auth
                <a class="btn btn-pawcare"
                   href="{{ route('events.create') }}">
                    + Crear esdeveniment
                </a>
            @endauth
        </div>

        {{-- Pestanyes --}}
        <div class="event-tabs">
            <a href="{{ route('events.index', ['when' => 'upcoming']) }}"
               class="event-tab {{ $when === 'upcoming' ? 'active' : '' }}">
                Próxims
            </a>

            <a href="{{ route('events.index', ['when' => 'past']) }}"
               class="event-tab {{ $when === 'past' ? 'active' : '' }}">
                Passats
            </a>
        </div>

        {{-- Filtres --}}
        <form method="GET" class="event-filter-form">

            <input type="hidden" name="when" value="{{ $when }}">

            <input
                name="search"
                placeholder="Cercar esdeveniment..."
                value="{{ request('search') }}"
            >

            <input
                name="city"
                placeholder="Ciutat"
                value="{{ request('city') }}"
            >

            <button class="btn btn-gray" type="submit">
                Filtrar
            </button>
        </form>

        {{-- Esdeveniments --}}
        <div class="grid">

            @forelse($events as $event)

                <div class="item">

                    <a href="{{ route('events.show', $event) }}">

                        @if($event->image_url)
                            <img class="cover"
                                 src="{{ $event->image_url }}"
                                 alt="{{ $event->title }}">
                        @else
                            <div class="cover event-placeholder">
                                🎉
                            </div>
                        @endif

                    </a>

                    <div class="body">

                        <h3>
                            <a href="{{ route('events.show', $event) }}">
                                {{ $event->title }}
                            </a>
                        </h3>

                        @if($event->is_cancelled)
                            <span class="badge badge-red">
                            Cancel·lat
                        </span>
                        @endif

                        <div class="muted">
                            🗓 {{ $event->starts_at->translatedFormat('d M Y, H:i') }}
                        </div>

                        <div class="muted">
                            📍 {{ $event->location_name ?? $event->city ?? '-' }}
                        </div>

                        <div class="muted">
                            {{ $event->is_free
                                ? 'Gratuït'
                                : number_format($event->price, 2, ',', '.') . ' €' }}
                        </div>

                        <x-interactions :model="$event" />

                    </div>
                </div>

            @empty

                <p>No hi ha esdeveniments per mostrar.</p>

            @endforelse

        </div>

        {{ $events->links() }}

    </div>
@endsection

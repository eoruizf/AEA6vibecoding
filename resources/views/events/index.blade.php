@extends('layouts.app')
@section('title', 'Eventos')
@section('content')
<div class="card">
    <div class="row" style="justify-content:space-between">
        <h2>Eventos</h2>
        @auth<a class="btn" href="{{ route('events.create') }}">+ Crear evento</a>@endauth
    </div>

    <div class="row" style="margin-top:8px">
        <a class="btn {{ $when === 'upcoming' ? '' : 'btn-outline' }}" href="{{ route('events.index', ['when' => 'upcoming']) }}">Próximos</a>
        <a class="btn {{ $when === 'past' ? '' : 'btn-outline' }}" href="{{ route('events.index', ['when' => 'past']) }}">Pasados</a>
    </div>

    <form method="GET" class="row" style="margin-top:12px">
        <input type="hidden" name="when" value="{{ $when }}">
        <input name="search" placeholder="Buscar..." value="{{ request('search') }}" style="max-width:220px">
        <input name="city" placeholder="Ciudad" value="{{ request('city') }}" style="max-width:150px">
        <button class="btn btn-gray">Filtrar</button>
    </form>

    <div class="grid">
        @forelse($events as $event)
            <div class="item">
                <a href="{{ route('events.show', $event) }}">
                    @if($event->image_url)
                        <img class="cover" src="{{ $event->image_url }}" alt="{{ $event->title }}">
                    @else
                        <div class="cover">🎉</div>
                    @endif
                </a>
                <div class="body">
                    <h3><a href="{{ route('events.show', $event) }}">{{ $event->title }}</a></h3>
                    @if($event->is_cancelled)<span class="badge badge-red">Cancelado</span>@endif
                    <div class="muted">🗓 {{ $event->starts_at->translatedFormat('d M Y, H:i') }}</div>
                    <div class="muted">📍 {{ $event->location_name ?? $event->city ?? '-' }}</div>
                    <div class="muted">{{ $event->is_free ? 'Gratis' : number_format($event->price, 2, ',', '.').' €' }}</div>
                    <x-interactions :model="$event" />
                </div>
            </div>
        @empty
            <p>No hay eventos.</p>
        @endforelse
    </div>

    {{ $events->links() }}
</div>
@endsection
@extends('layouts.app')
@section('title', $event->title)
@section('content')
<div class="card">
    <div class="row" style="justify-content:space-between">
        <h2>{{ $event->title }}
            @if($event->is_cancelled)<span class="badge badge-red">Cancelado</span>@endif
        </h2>
        @can('update', $event)
            <div class="row">
                <a class="btn btn-gray" href="{{ route('events.edit', $event) }}">Editar</a>
                <form method="POST" action="{{ route('events.destroy', $event) }}" onsubmit="return confirm('¿Eliminar este evento?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        @endcan
    </div>

    @if($event->image_url)
        <img src="{{ $event->image_url }}" alt="{{ $event->title }}" style="max-width:100%;border-radius:8px;margin-bottom:16px">
    @endif

    <p>{{ $event->description }}</p>

    <table>
        <tr><th>Fecha</th><td>{{ $event->starts_at->translatedFormat('l d F Y, H:i') }}
            @if($event->ends_at) – {{ $event->ends_at->format('H:i') }} @endif</td></tr>
        <tr><th>Lugar</th><td>{{ $event->location_name ?? '-' }}</td></tr>
        <tr><th>Dirección</th><td>{{ collect([$event->address, $event->city])->filter()->implode(', ') ?: '-' }}</td></tr>
        <tr><th>Precio</th><td>{{ $event->is_free ? 'Gratis' : number_format($event->price, 2, ',', '.').' €' }}</td></tr>
        <tr><th>Plazas</th><td>{{ $event->max_attendees ?? 'Sin límite' }}</td></tr>
        <tr><th>Organiza</th><td>{{ $event->user->name }}</td></tr>
    </table>

    <x-interactions :model="$event" />
    <x-comments :model="$event" />
</div>
@endsection
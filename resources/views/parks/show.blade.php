@extends('layouts.app')
@section('title', $park->name)
@section('content')
<div class="card">
    <div class="row" style="justify-content:space-between">
        <h2>{{ $park->name }}</h2>
        @can('update', $park)
            <div class="row">
                <a class="btn btn-gray" href="{{ route('admin.parks.edit', $park) }}">Editar</a>
                <form method="POST" action="{{ route('admin.parks.destroy', $park) }}" onsubmit="return confirm('¿Eliminar este parque?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        @endcan
    </div>

    @if($park->image_url)
        <img src="{{ $park->image_url }}" alt="{{ $park->name }}" style="max-width:100%;max-height:420px;object-fit:cover;border-radius:8px;margin-bottom:16px">
    @endif

    <p>{{ $park->description ?? 'Sin descripción.' }}</p>

    <table>
        <tr><th>Dirección</th><td>{{ $park->address }}</td></tr>
        <tr><th>Ciudad</th><td>{{ $park->city }}</td></tr>
        <tr><th>Zona canina</th><td>{{ $park->has_dog_zone ? 'Sí' : 'No' }}</td></tr>
        <tr><th>Horarios</th><td>{{ $park->opening_hours ?? '-' }}</td></tr>
        <tr><th>Servicios</th><td>{{ $park->services ? implode(', ', $park->services) : '-' }}</td></tr>
        <tr><th>Teléfono</th><td>{{ $park->phone ?? '-' }}</td></tr>
        <tr><th>Email</th><td>{{ $park->email ?? '-' }}</td></tr>
        <tr><th>Web</th><td>
            @if($park->website)
                <a href="{{ $park->website }}" target="_blank" rel="noopener">{{ $park->website }}</a>
            @else
                -
            @endif
        </td></tr>
        <tr><th>Coordenadas</th><td>
            @if($park->latitude !== null && $park->longitude !== null)
                {{ $park->latitude }}, {{ $park->longitude }}
            @else
                -
            @endif
        </td></tr>
    </table>

    <x-interactions :model="$park" />
    <x-comments :model="$park" />
</div>
@endsection

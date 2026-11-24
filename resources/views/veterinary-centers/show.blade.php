@extends('layouts.app')
@section('title', $veterinaryCenter->name)
@section('content')
<div class="card">
    <div class="row" style="justify-content:space-between">
        <h2>{{ $veterinaryCenter->name }}</h2>
        @can('update', $veterinaryCenter)
            <div class="row">
                <a class="btn btn-gray" href="{{ route('admin.veterinary-centers.edit', $veterinaryCenter) }}">Editar</a>
                <form method="POST" action="{{ route('admin.veterinary-centers.destroy', $veterinaryCenter) }}" onsubmit="return confirm('¿Eliminar este centro veterinario?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        @endcan
    </div>

    @if($veterinaryCenter->image_url)
        <img src="{{ $veterinaryCenter->image_url }}" alt="{{ $veterinaryCenter->name }}" style="max-width:100%;max-height:420px;object-fit:cover;border-radius:8px;margin-bottom:16px">
    @endif

    <p>{{ $veterinaryCenter->description ?? 'Sin descripción.' }}</p>

    <table>
        <tr><th>Dirección</th><td>{{ $veterinaryCenter->address }}</td></tr>
        <tr><th>Ciudad</th><td>{{ $veterinaryCenter->city }}</td></tr>
        <tr><th>Horarios</th><td>{{ $veterinaryCenter->opening_hours ?? '-' }}</td></tr>
        <tr><th>Servicios</th><td>{{ $veterinaryCenter->services ? implode(', ', $veterinaryCenter->services) : '-' }}</td></tr>
        <tr><th>Teléfono</th><td>{{ $veterinaryCenter->phone ?? '-' }}</td></tr>
        <tr><th>Email</th><td>{{ $veterinaryCenter->email ?? '-' }}</td></tr>
        <tr><th>Web</th><td>
            @if($veterinaryCenter->website)
                <a href="{{ $veterinaryCenter->website }}" target="_blank" rel="noopener">{{ $veterinaryCenter->website }}</a>
            @else
                -
            @endif
        </td></tr>
        <tr><th>Coordenadas</th><td>
            @if($veterinaryCenter->latitude !== null && $veterinaryCenter->longitude !== null)
                {{ $veterinaryCenter->latitude }}, {{ $veterinaryCenter->longitude }}
            @else
                -
            @endif
        </td></tr>
    </table>

    <x-interactions :model="$veterinaryCenter" />
    <x-comments :model="$veterinaryCenter" />
</div>
@endsection

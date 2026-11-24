@extends('layouts.app')
@section('title', 'Parques')
@section('content')
<div class="card">
    <div class="row" style="justify-content:space-between">
        <h2>Parques para perros</h2>
        @can('create', \App\Models\Park::class)
            <a class="btn" href="{{ route('admin.parks.create') }}">+ Nuevo parque</a>
        @endcan
    </div>

    <form method="GET" class="row" style="flex-wrap:wrap;margin-top:12px">
        <input name="search" placeholder="Nombre del parque" value="{{ request('search') }}" style="max-width:220px">
        <input name="city" placeholder="Ciudad" value="{{ request('city') }}" style="max-width:150px">
        <select name="dog_zone" style="max-width:180px">
            <option value="">Zona canina</option>
            <option value="yes" @selected(request('dog_zone') === 'yes')>Sí</option>
            <option value="no" @selected(request('dog_zone') === 'no')>No</option>
        </select>
        <button class="btn btn-gray">Filtrar</button>
    </form>

    <div class="grid">
        @forelse($parks as $park)
            <div class="item">
                <a href="{{ route('parks.show', $park) }}">
                    @if($park->image_url)
                        <img class="cover" src="{{ $park->image_url }}" alt="{{ $park->name }}">
                    @else
                        <div class="cover">🌳</div>
                    @endif
                </a>
                <div class="body">
                    <h3><a href="{{ route('parks.show', $park) }}">{{ $park->name }}</a></h3>
                    @if($park->has_dog_zone)
                        <span class="badge badge-ok">Zona canina</span>
                    @endif
                    <div class="muted">📍 {{ $park->city }}</div>
                    <div class="muted">{{ $park->address }}</div>
                </div>
            </div>
        @empty
            <p>No hay parques con esos filtros.</p>
        @endforelse
    </div>

    {{ $parks->links() }}
</div>
@endsection

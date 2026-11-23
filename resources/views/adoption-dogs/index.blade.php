@extends('layouts.app')
@section('title', 'Adopciones')
@section('content')
<div class="card">
    <div class="row" style="justify-content:space-between">
        <h2>Perros en adopción</h2>
        @auth<a class="btn" href="{{ route('adoption-dogs.create') }}">+ Publicar perro</a>@endauth
    </div>

    <form method="GET" class="row" style="flex-wrap:wrap;margin-top:12px">
        <input name="search" placeholder="Nombre o raza" value="{{ request('search') }}" style="max-width:200px">
        <input name="city" placeholder="Ciudad" value="{{ request('city') }}" style="max-width:150px">
        <select name="sex" style="max-width:130px">
            <option value="">Sexo</option>
            @foreach(\App\Models\AdoptionDog::SEXES as $k => $l)
                <option value="{{ $k }}" @selected(request('sex') === $k)>{{ $l }}</option>
            @endforeach
        </select>
        <select name="size" style="max-width:130px">
            <option value="">Tamaño</option>
            @foreach(\App\Models\AdoptionDog::SIZES as $k => $l)
                <option value="{{ $k }}" @selected(request('size') === $k)>{{ $l }}</option>
            @endforeach
        </select>
        <select name="status" style="max-width:140px">
            <option value="all" @selected($status === 'all')>Todos</option>
            @foreach(\App\Models\AdoptionDog::STATUSES as $k => $l)
                <option value="{{ $k }}" @selected($status === $k)>{{ $l }}</option>
            @endforeach
        </select>
        <button class="btn btn-gray">Filtrar</button>
    </form>

    <div class="grid">
        @forelse($dogs as $dog)
            <div class="item">
                <a href="{{ route('adoption-dogs.show', $dog) }}">
                    @if($dog->photo_urls)
                        <img class="cover" src="{{ $dog->photo_urls[0] }}" alt="{{ $dog->name }}">
                    @else
                        <div class="cover">🐶</div>
                    @endif
                </a>
                <div class="body">
                    <h3><a href="{{ route('adoption-dogs.show', $dog) }}">{{ $dog->name }}</a>
                        <span class="badge {{ $dog->status_class }}">{{ $dog->status_label }}</span></h3>
                    <div class="muted">{{ $dog->breed ?? 'Raza desconocida' }} · {{ $dog->sex_label }} · {{ $dog->age ?? '-' }}</div>
                    <div class="muted">📍 {{ $dog->city ?? '-' }}</div>
                    <x-interactions :model="$dog" />
                </div>
            </div>
        @empty
            <p>No hay perros con esos filtros.</p>
        @endforelse
    </div>

    {{ $dogs->links() }}
</div>
@endsection
@extends('layouts.app')
@section('title', 'Centros veterinarios')
@section('content')
<div class="card">
    <div class="row" style="justify-content:space-between">
        <h2>Centros veterinarios</h2>
        @can('create', \App\Models\VeterinaryCenter::class)
            <a class="btn" href="{{ route('admin.veterinary-centers.create') }}">+ Nuevo centro</a>
        @endcan
    </div>

    <form method="GET" class="row" style="flex-wrap:wrap;margin-top:12px">
        <input name="search" placeholder="Nombre del centro" value="{{ request('search') }}" style="max-width:220px">
        <input name="city" placeholder="Ciudad" value="{{ request('city') }}" style="max-width:150px">
        <select name="service" style="max-width:180px">
            <option value="">Servicio</option>
            @foreach(\App\Http\Controllers\VeterinaryCenterController::SERVICES as $service)
                <option value="{{ $service }}" @selected(request('service') === $service)>{{ $service }}</option>
            @endforeach
        </select>
        <button class="btn btn-gray">Filtrar</button>
    </form>

    <div class="grid">
        @forelse($centers as $center)
            <div class="item">
                <a href="{{ route('veterinary-centers.show', $center) }}">
                    @if($center->image_url)
                        <img class="cover" src="{{ $center->image_url }}" alt="{{ $center->name }}">
                    @else
                        <div class="cover">🩺</div>
                    @endif
                </a>
                <div class="body">
                    <h3><a href="{{ route('veterinary-centers.show', $center) }}">{{ $center->name }}</a></h3>
                    @foreach(array_slice($center->services ?? [], 0, 3) as $service)
                        <span class="badge" style="margin-right:4px">{{ $service }}</span>
                    @endforeach
                    <div class="muted" style="margin-top:6px">📍 {{ $center->city }}</div>
                    <div class="muted">{{ $center->address }}</div>
                </div>
            </div>
        @empty
            <p>No hay centros veterinarios con esos filtros.</p>
        @endforelse
    </div>

    {{ $centers->links() }}
</div>
@endsection

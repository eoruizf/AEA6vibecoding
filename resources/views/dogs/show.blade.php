@extends('layouts.app')
@section('title', $dog->name)
@section('content')
<div class="card">
    <div class="row" style="justify-content:space-between">
        <h2>{{ $dog->name }}</h2>
        <a class="btn btn-gray" href="{{ route('dogs.edit', $dog) }}">Editar</a>
    </div>

    <div class="row" style="flex-wrap:wrap;margin-bottom:16px">
        @foreach($dog->photo_urls as $url)
            <img src="{{ $url }}" alt="{{ $dog->name }}" style="width:180px;height:180px;object-fit:cover;border-radius:8px">
        @endforeach
    </div>

    <p>{{ $dog->description }}</p>
    <table>
        <tr><th>Raza</th><td>{{ $dog->breed ?? '-' }}</td></tr>
        <tr><th>Sexo</th><td>{{ $dog->sex_label }}</td></tr>
        <tr><th>Edad</th><td>{{ $dog->age ?? '-' }}</td></tr>
        <tr><th>Peso</th><td>{{ $dog->weight ? $dog->weight.' kg' : '-' }}</td></tr>
        <tr><th>Color</th><td>{{ $dog->color ?? '-' }}</td></tr>
        <tr><th>Esterilizado/a</th><td>{{ $dog->is_neutered ? 'Sí' : 'No' }}</td></tr>
        <tr><th>Microchip</th><td>{{ $dog->microchip_number ?? '-' }}</td></tr>
        <tr><th>Dueño</th><td>{{ $dog->user->name }} ({{ $dog->user->contact_phone ?? $dog->user->email }})</td></tr>
    </table>

    <x-interactions :model="$dog" />
    <x-comments :model="$dog" />
</div>
@endsection
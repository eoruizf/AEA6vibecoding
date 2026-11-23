@extends('layouts.app')
@section('title', $dog->name)
@section('content')
<div class="card">
    <div class="row" style="justify-content:space-between">
        <h2>{{ $dog->name }} <span class="badge {{ $dog->status_class }}">{{ $dog->status_label }}</span></h2>
        @can('update', $dog)
            <div class="row">
                <a class="btn btn-gray" href="{{ route('adoption-dogs.edit', $dog) }}">Editar</a>
                <form method="POST" action="{{ route('adoption-dogs.destroy', $dog) }}" onsubmit="return confirm('¿Eliminar este anuncio?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        @endcan
    </div>

    <div class="gallery">
        @foreach($dog->photo_urls as $url)
            <img src="{{ $url }}" alt="{{ $dog->name }}">
        @endforeach
    </div>

    <p>{{ $dog->description }}</p>

    <table>
        <tr><th>Raza</th><td>{{ $dog->breed ?? '-' }}</td></tr>
        <tr><th>Sexo</th><td>{{ $dog->sex_label }}</td></tr>
        <tr><th>Tamaño</th><td>{{ $dog->size_label ?? '-' }}</td></tr>
        <tr><th>Edad</th><td>{{ $dog->age ?? '-' }}</td></tr>
        <tr><th>Peso</th><td>{{ $dog->weight ? $dog->weight.' kg' : '-' }}</td></tr>
        <tr><th>Color</th><td>{{ $dog->color ?? '-' }}</td></tr>
        <tr><th>Ciudad</th><td>{{ $dog->city ?? '-' }}</td></tr>
        <tr><th>Esterilizado/a</th><td>{{ $dog->is_neutered ? 'Sí' : 'No' }}</td></tr>
        <tr><th>Vacunado/a</th><td>{{ $dog->is_vaccinated ? 'Sí' : 'No' }}</td></tr>
        <tr><th>Microchip</th><td>{{ $dog->is_microchipped ? 'Sí' : 'No' }}</td></tr>
        <tr><th>Bueno con niños</th><td>{{ $dog->good_with_kids ? 'Sí' : 'No' }}</td></tr>
        <tr><th>Bueno con otros perros</th><td>{{ $dog->good_with_dogs ? 'Sí' : 'No' }}</td></tr>
        <tr><th>Requisitos</th><td>{{ $dog->adoption_requirements ?? '-' }}</td></tr>
        <tr>
            <th>Contacto</th>
            <td>
                {{ $dog->user->name }}
                @if($dog->user->contact_phone) · {{ $dog->user->contact_phone }} @endif
                @if($dog->user->contact_email ?? $dog->user->email) · {{ $dog->user->contact_email ?? $dog->user->email }} @endif
            </td>
        </tr>
    </table>

    <x-interactions :model="$dog" />
    <x-comments :model="$dog" />
</div>
@endsection
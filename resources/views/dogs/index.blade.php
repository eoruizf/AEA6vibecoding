@extends('layouts.app')
@section('title', 'Perros')
@section('content')
<div class="card">
    <div class="row" style="justify-content:space-between">
        <h2>{{ auth()->user()->isAdmin() ? 'Todos los perros' : 'Mis perros' }}</h2>
        <a class="btn" href="{{ route('dogs.create') }}">+ Nuevo perro</a>
    </div>

    <table>
        <thead>
            <tr>
                <th></th><th>Nombre</th><th>Raza</th><th>Sexo</th><th>Edad</th>
                @if(auth()->user()->isAdmin())<th>Dueño</th>@endif
                <th></th>
            </tr>
        </thead>
        <tbody>
        @forelse($dogs as $dog)
            <tr>
                <td>
                    @if($dog->photo_urls)
                        <img src="{{ $dog->photo_urls[0] }}" alt="" style="width:48px;height:48px;object-fit:cover;border-radius:6px">
                    @endif
                </td>
                <td><a href="{{ route('dogs.show', $dog) }}">{{ $dog->name }}</a></td>
                <td>{{ $dog->breed ?? '-' }}</td>
                <td>{{ $dog->sex_label }}</td>
                <td>{{ $dog->age ?? '-' }}</td>
                @if(auth()->user()->isAdmin())<td>{{ $dog->user->name }}</td>@endif
                <td class="row">
                    <a class="btn btn-gray" href="{{ route('dogs.edit', $dog) }}">Editar</a>
                    <form method="POST" action="{{ route('dogs.destroy', $dog) }}" onsubmit="return confirm('¿Eliminar este perro?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="7">Todavía no tienes ningún perro.</td></tr>
        @endforelse
        </tbody>
    </table>

    {{ $dogs->links() }}
</div>
@endsection
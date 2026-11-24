@extends('layouts.app')
@section('title', 'Favoritos')
@section('content')
@php $labels = [
    'event' => 'Evento',
    'adoption_dog' => 'Adopción',
    'dog' => 'Perro',
    'park' => 'Parque',
    'veterinary_center' => 'Centro veterinario',
]; @endphp
<div class="card">
    <h2>Mis favoritos</h2>
    <table>
        <thead><tr><th>Tipo</th><th>Título</th><th></th></tr></thead>
        <tbody>
        @forelse($favorites as $f)
            @if($f->favoritable)
                <tr>
                    <td><span class="badge">{{ $labels[$f->favoritable_type] ?? $f->favoritable_type }}</span></td>
                    <td><a href="{{ $f->favoritable->show_url }}">{{ $f->favoritable->display_title }}</a></td>
                    <td>
                        <form method="POST" action="{{ route('favorites.toggle', [$f->favoritable_type, $f->favoritable_id]) }}">
                            @csrf
                            <button class="btn btn-danger">Quitar</button>
                        </form>
                    </td>
                </tr>
            @endif
        @empty
            <tr><td colspan="3">Todavía no tienes favoritos.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
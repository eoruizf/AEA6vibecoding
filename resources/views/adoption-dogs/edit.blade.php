@extends('layouts.app')
@section('title', 'Editar anuncio')
@section('content')
<div class="card">
    <h2>Editar: {{ $dog->name }}</h2>
    <form method="POST" action="{{ route('adoption-dogs.update', $dog) }}" enctype="multipart/form-data">
        @method('PUT')
        @include('adoption-dogs._form')
    </form>
</div>
@endsection
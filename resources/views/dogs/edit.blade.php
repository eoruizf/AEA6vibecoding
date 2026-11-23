@extends('layouts.app')
@section('title', 'Editar perro')
@section('content')
<div class="card">
    <h2>Editar: {{ $dog->name }}</h2>
    <form method="POST" action="{{ route('dogs.update', $dog) }}" enctype="multipart/form-data">
        @method('PUT')
        @include('dogs._form')
    </form>
</div>
@endsection
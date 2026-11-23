@extends('layouts.app')
@section('title', 'Publicar perro')
@section('content')
<div class="card">
    <h2>Publicar perro en adopción</h2>
    <form method="POST" action="{{ route('adoption-dogs.store') }}" enctype="multipart/form-data">
        @include('adoption-dogs._form')
    </form>
</div>
@endsection
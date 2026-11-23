@extends('layouts.app')
@section('title', 'Nuevo perro')
@section('content')
<div class="card">
    <h2>Nuevo perro</h2>
    <form method="POST" action="{{ route('dogs.store') }}" enctype="multipart/form-data">
        @include('dogs._form')
    </form>
</div>
@endsection
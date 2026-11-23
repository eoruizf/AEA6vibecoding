@extends('layouts.app')
@section('title', 'Editar evento')
@section('content')
<div class="card">
    <h2>Editar: {{ $event->title }}</h2>
    <form method="POST" action="{{ route('events.update', $event) }}" enctype="multipart/form-data">
        @method('PUT')
        @include('events._form')
    </form>
</div>
@endsection
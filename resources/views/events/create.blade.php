@extends('layouts.app')
@section('title', 'Nuevo evento')
@section('content')
<div class="card">
    <h2>Nuevo evento</h2>
    <form method="POST" action="{{ route('events.store') }}" enctype="multipart/form-data">
        @include('events._form')
    </form>
</div>
@endsection
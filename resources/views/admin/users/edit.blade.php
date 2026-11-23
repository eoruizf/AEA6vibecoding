@extends('layouts.app')
@section('title', 'Editar usuario')
@section('content')
<div class="card">
    <h2>Editar: {{ $user->name }}</h2>
    <form method="POST" action="{{ route('admin.users.update', $user) }}">
        @method('PUT')
        @include('admin.users._form')
    </form>
</div>
@endsection
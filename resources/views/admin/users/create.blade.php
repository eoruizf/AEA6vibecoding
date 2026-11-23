@extends('layouts.app')
@section('title', 'Nuevo usuario')
@section('content')
<div class="card">
    <h2>Nuevo usuario</h2>
    <form method="POST" action="{{ route('admin.users.store') }}">
        @include('admin.users._form')
    </form>
</div>
@endsection
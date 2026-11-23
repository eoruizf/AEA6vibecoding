@extends('layouts.app')
@section('title', 'Inicio')
@section('content')
<div class="card">
    <div class="row" style="margin-bottom:12px">
        <x-avatar :user="auth()->user()" :size="72" />
        <h2>Bienvenido, {{ auth()->user()->name }} 👋</h2>
    </div>

    <p>Rol: <span class="badge {{ auth()->user()->isAdmin() ? 'badge-admin' : '' }}">{{ auth()->user()->role_label }}</span></p>
    <p>Correo: {{ auth()->user()->email }}</p>
</div>
@endsection
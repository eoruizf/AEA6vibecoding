@extends('layouts.app')
@section('title', 'Iniciar sesión')
@section('content')
<div class="card" style="max-width:420px;margin:auto">
    <h2>Iniciar sesión</h2>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <label>Correo electrónico</label>
        <input type="email" name="email" value="{{ old('email') }}" required autofocus>
        <label>Contraseña</label>
        <input type="password" name="password" required>
        <label><input type="checkbox" name="remember"> Recordarme</label>
        <br>
        <button class="btn">Entrar</button>
        <a href="{{ route('register') }}">¿No tienes cuenta?</a>
    </form>
</div>
@endsection
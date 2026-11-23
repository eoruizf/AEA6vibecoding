@extends('layouts.app')
@section('title', 'Registro')
@section('content')
<div class="card" style="max-width:480px;margin:auto">
    <h2>Crear cuenta</h2>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <label>Nombre</label>
        <input name="name" value="{{ old('name') }}" required>
        <label>Correo electrónico</label>
        <input type="email" name="email" value="{{ old('email') }}" required>
        <label>Contraseña</label>
        <input type="password" name="password" required>
        <label>Confirmar contraseña</label>
        <input type="password" name="password_confirmation" required>
        <label>Teléfono de contacto (opcional)</label>
        <input name="contact_phone" value="{{ old('contact_phone') }}">
        <label>Correo de contacto (opcional)</label>
        <input type="email" name="contact_email" value="{{ old('contact_email') }}">
        <br><br>
        <button class="btn">Registrarme</button>
    </form>
</div>
@endsection
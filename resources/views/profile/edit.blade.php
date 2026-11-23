@extends('layouts.app')
@section('title', 'Perfil')
@section('content')
<div class="card">
    <h2>Mi perfil</h2>
<form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
    @csrf @method('PUT')

        <div class="row" style="margin-bottom:8px">
            <x-avatar :user="$user" :size="80" />
            <div>
                <label style="margin-top:0">Foto de perfil (máx. 2 MB)</label>
                <input type="file" name="photo" accept="image/*">
                @if($user->photo)
                    <label style="font-weight:400">
                        <input type="checkbox" name="remove_photo" value="1"> Eliminar foto actual
                    </label>
                @endif
            </div>
        </div>
        <label>Nombre</label>
        <input name="name" value="{{ old('name', $user->name) }}" required>
        <label>Correo electrónico</label>
        <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
        <label>Teléfono de contacto</label>
        <input name="contact_phone" value="{{ old('contact_phone', $user->contact_phone) }}">
        <label>Correo de contacto</label>
        <input type="email" name="contact_email" value="{{ old('contact_email', $user->contact_email) }}">
        <label>Nueva contraseña (déjala vacía para no cambiarla)</label>
        <input type="password" name="password">
        <label>Confirmar contraseña</label>
        <input type="password" name="password_confirmation">
        <br><br>
        <button class="btn">Guardar</button>
    </form>
</div>
@endsection
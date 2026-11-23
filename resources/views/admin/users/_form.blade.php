@csrf
<label>Nombre</label>
<input name="name" value="{{ old('name', $user->name ?? '') }}" required>

<label>Correo electrónico</label>
<input type="email" name="email" value="{{ old('email', $user->email ?? '') }}" required>

<label>Contraseña {{ isset($user) ? '(déjala vacía para no cambiarla)' : '' }}</label>
<input type="password" name="password" {{ isset($user) ? '' : 'required' }}>

<label>Rol</label>
<select name="role" required>
    @foreach(\App\Models\User::ROLES as $r)
        <option value="{{ $r }}" @selected(old('role', $user->role ?? 'user') === $r)>{{ $r === 'admin' ? 'Administrador' : 'Usuario' }}</option>
    @endforeach
</select>

<label>Teléfono de contacto</label>
<input name="contact_phone" value="{{ old('contact_phone', $user->contact_phone ?? '') }}">

<label>Correo de contacto</label>
<input type="email" name="contact_email" value="{{ old('contact_email', $user->contact_email ?? '') }}">

<br><br>
<button class="btn">Guardar</button>
<a class="btn btn-gray" href="{{ route('admin.users.index') }}">Volver</a>
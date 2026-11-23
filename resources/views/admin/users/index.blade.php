@extends('layouts.app')
@section('title', 'Usuarios')
@section('content')
<div class="card">
    <div class="row" style="justify-content:space-between">
        <h2>Usuarios</h2>
        <a class="btn" href="{{ route('admin.users.create') }}">+ Nuevo usuario</a>
    </div>

    <form method="GET" class="row" style="margin-bottom:16px">
        <input name="search" placeholder="Buscar..." value="{{ request('search') }}">
        <select name="role" style="max-width:160px">
            <option value="">Todos</option>
            @foreach(\App\Models\User::ROLES as $r)
                <option value="{{ $r }}" @selected(request('role') === $r)>{{ $r === 'admin' ? 'Administrador' : 'Usuario' }}</option>
            @endforeach
        </select>
        <button class="btn btn-gray">Filtrar</button>
    </form>

    <table>
        <thead><tr><th>#</th><th>Nombre</th><th>Correo</th><th>Rol</th><th>Teléfono</th><th></th></tr></thead>
        <tbody>
        @forelse($users as $u)
            <tr>
                <td>{{ $u->id }}</td>
                <td><div class="row"><x-avatar :user="$u" :size="32" /> {{ $u->name }}</div></td>
                <td>{{ $u->email }}</td>
                <td><span class="badge {{ $u->isAdmin() ? 'badge-admin' : '' }}">{{ $u->role_label }}</span></td>
                <td>{{ $u->contact_phone }}</td>
                <td class="row">
                    <a class="btn btn-gray" href="{{ route('admin.users.edit', $u) }}">Editar</a>
                    @unless($u->is(auth()->user()))
                    <form method="POST" action="{{ route('admin.users.destroy', $u) }}"
                          onsubmit="return confirm('¿Eliminar este usuario?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger">Eliminar</button>
                    </form>
                    @endunless
                </td>
            </tr>
        @empty
            <tr><td colspan="6">No hay usuarios.</td></tr>
        @endforelse
        </tbody>
    </table>

    {{ $users->links() }}
</div>
@endsection
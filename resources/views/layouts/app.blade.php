<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'My App')</title>
    <style>
        *{box-sizing:border-box}
        body{font-family:system-ui,sans-serif;margin:0;background:#f4f5f7;color:#222}
        nav{background:#1f2937;color:#fff;padding:12px 24px;display:flex;gap:16px;align-items:center}
        nav a{color:#fff;text-decoration:none}
        nav .spacer{flex:1}
        nav form{margin:0}
        main{max-width:900px;margin:24px auto;padding:0 16px}
        .card{background:#fff;border-radius:8px;padding:24px;box-shadow:0 1px 3px rgba(0,0,0,.1)}
        label{display:block;margin:12px 0 4px;font-weight:600}
        input,select{width:100%;padding:8px;border:1px solid #ccc;border-radius:6px}
        input[type=checkbox]{width:auto}
        .btn{display:inline-block;padding:8px 16px;border:0;border-radius:6px;background:#2563eb;color:#fff;cursor:pointer;text-decoration:none;font-size:14px}
        .btn-danger{background:#dc2626}.btn-gray{background:#6b7280}
        .alert{padding:10px 14px;border-radius:6px;margin-bottom:16px}
        .alert-success{background:#dcfce7;color:#166534}
        .alert-error{background:#fee2e2;color:#991b1b}
        table{width:100%;border-collapse:collapse}
        th,td{text-align:left;padding:8px;border-bottom:1px solid #eee}
        .badge{padding:2px 8px;border-radius:99px;font-size:12px;background:#e5e7eb}
        .badge-admin{background:#fde68a}
        .row{display:flex;gap:8px;align-items:center}
        .pagination{display:flex;gap:6px;margin-top:16px;list-style:none;padding:0}
        .err{color:#dc2626;font-size:13px}
    </style>
</head>
<body>
<nav>
    <strong>My App</strong>
    @auth
        <a href="{{ route('dashboard') }}">Inicio</a>
        <a href="{{ route('profile.edit') }}">Perfil</a>
        <a href="{{ route('dogs.index') }}">Mis perros</a>
        @if(auth()->user()->isAdmin())
            <a href="{{ route('admin.users.index') }}">Usuarios</a>
        @endif
        <span class="spacer"></span>
        <x-avatar :user="auth()->user()" :size="32" />
        <span>{{ auth()->user()->name }}</span>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-gray">Cerrar sesión</button>
        </form>
    @else
        <span class="spacer"></span>
        <a href="{{ route('login') }}">Iniciar sesión</a>
        <a href="{{ route('register') }}">Registrarse</a>
    @endauth
</nav>

<main>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-error">
            @foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach
        </div>
    @endif

    @yield('content')
</main>
</body>
</html>
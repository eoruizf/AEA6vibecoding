
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'PawCare') | Cuidem dels nostres millors amics</title>

    <meta name="description"
          content="PawCare: plataforma per gestionar els teus gossos i descobrir adopcions i esdeveniments.">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
          rel="stylesheet">

    <!-- CSS PawCare -->
    <link rel="stylesheet" href="{{ asset('css/pawcare.css') }}">

    <!-- Estils necessaris per al backend -->
    <style>
        body {
            font-family: system-ui, sans-serif;
            background: #f4f5f7;
            color: #222;
            margin: 0;
        }

        .pawcare-navbar {
            background: #287c72;
        }

        .pawcare-navbar .navbar-brand {
            font-weight: 700;
            color: white;
        }

        .pawcare-navbar .nav-link {
            color: rgba(255,255,255,.9);
        }

        .pawcare-navbar .nav-link:hover {
            color: white;
        }

        .pawcare-main {
            min-height: 65vh;
            padding-top: 24px;
            padding-bottom: 24px;
        }

        .backend-card {
            background: white;
            border-radius: 8px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,.1);
        }

        label {
            display: block;
            margin: 12px 0 4px;
            font-weight: 600;
        }

        input, select, textarea {
            max-width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        input[type=checkbox] {
            width: auto;
        }

        .btn {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
        }

        .btn-danger {
            background: #dc2626;
            color: white;
        }

        .btn-gray {
            background: #6b7280;
            color: white;
        }

        .alert {
            padding: 10px 14px;
            border-radius: 6px;
            margin-bottom: 16px;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            text-align: left;
            padding: 8px;
            border-bottom: 1px solid #eee;
        }

        .badge-admin {
            background: #fde68a;
        }

        .pagination {
            display: flex;
            gap: 6px;
            margin-top: 16px;
            list-style: none;
            padding: 0;
        }

        .err {
            color: #dc2626;
            font-size: 13px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 16px;
            margin-top: 16px;
        }

        .item {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,.1);
        }

        .item .cover {
            width: 100%;
            height: 160px;
            object-fit: cover;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #e5e7eb;
            font-size: 42px;
        }

        .item .body {
            padding: 12px;
        }

        .item h3 {
            margin: 0 0 6px;
        }

        .muted {
            color: #6b7280;
            font-size: 13px;
        }

        .btn-outline {
            background: white;
            color: #287c72;
            border: 1px solid #287c72;
        }

        .badge-ok {
            background: #dcfce7;
            color: #166534;
        }

        .badge-warn {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-off {
            background: #e5e7eb;
            color: #4b5563;
        }

        .badge-red {
            background: #fee2e2;
            color: #991b1b;
        }

        .interactions {
            margin-top: 10px;
        }

        .comment {
            border-top: 1px solid #eee;
            padding: 10px 0;
        }

        .gallery {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 16px;
        }

        .gallery img {
            width: 200px;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
        }

        textarea {
            width: 100%;
        }

        .pawcare-footer {
            background: #287c72;
            color: white;
            padding: 28px 0;
            margin-top: 30px;
        }

        .pawcare-footer a {
            color: white;
            text-decoration: none;
        }

        .pawcare-footer a:hover {
            text-decoration: underline;
        }
    </style>

    @stack('styles')
</head>

<body>

<!-- Navbar PawCare + navegació backend -->
<nav class="navbar navbar-expand-lg pawcare-navbar">
    <div class="container">

        <a class="navbar-brand" href="{{ url('/') }}">
            <i class="bi bi-heart-fill"></i> PawCare
        </a>

        <button class="navbar-toggler bg-light"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarPawCare"
                aria-controls="navbarPawCare"
                aria-expanded="false"
                aria-label="Obrir menú">

            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarPawCare">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">Inici</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('adoption-dogs.index') }}">
                        Adopcions
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('events.index') }}">
                        Esdeveniments
                    </a>
                </li>

                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('favorites.index') }}">
                            Favorits
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dogs.index') }}">
                            Els meus gossos
                        </a>
                    </li>
                @endauth

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/parcs') }}">
                        Parcs
                    </a>
                </li>

            </ul>

            <ul class="navbar-nav align-items-lg-center">

                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            Dashboard
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile.edit') }}">
                            Perfil
                        </a>
                    </li>

                    @if(auth()->user()->isAdmin())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.users.index') }}">
                                Administració
                            </a>
                        </li>
                    @endif

                    <li class="nav-item d-flex align-items-center gap-2 px-2">
                        <x-avatar :user="auth()->user()" :size="32" />
                        <span class="text-white">
                            {{ auth()->user()->name }}
                        </span>
                    </li>

                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button type="submit" class="btn btn-gray btn-sm">
                                Tancar sessió
                            </button>
                        </form>
                    </li>

                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            Iniciar sessió
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="btn btn-light btn-sm ms-lg-2"
                           href="{{ route('register') }}">
                            Registrar-se
                        </a>
                    </li>
                @endauth

            </ul>
        </div>
    </div>
</nav>

<!-- Contingut -->
<main class="{{ request()->routeIs('home') ? 'pawcare-home-main' : 'container pawcare-main' }}">

    <!-- Missatges del backend -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-error">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    @yield('content')

</main>

<!-- Footer PawCare -->
<footer class="pawcare-footer">
    <div class="container">
        <div class="row">

            <div class="col-md-6 mb-3">
                <h5>
                    <i class="bi bi-heart-fill"></i> PawCare
                </h5>

                <p class="mb-0">
                    Cuidem dels nostres millors amics.
                </p>
            </div>

            <div class="col-md-6 text-md-end">
                <a href="{{ url('/') }}">Inici</a>
                <span class="mx-2">|</span>
                <a href="{{ route('adoption-dogs.index') }}">Adopcions</a>
                <span class="mx-2">|</span>
                <a href="{{ route('events.index') }}">Esdeveniments</a>
            </div>

        </div>

        <hr class="border-light">

        <p class="text-center mb-0">
            &copy; {{ date('Y') }} PawCare
        </p>
    </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@stack('scripts')

</body>
</html>

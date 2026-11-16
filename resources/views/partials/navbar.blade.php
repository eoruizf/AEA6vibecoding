
<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top pawcare-navbar">
    <div class="container">

        <!-- Logotip -->
        <a class="navbar-brand pawcare-brand" href="{{ url('/') }}">
            <i class="bi bi-heart-fill"></i>
            PawCare<span>.</span>
        </a>

        <!-- Botó mòbil -->
        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mainNavbar"
                aria-controls="mainNavbar"
                aria-expanded="false"
                aria-label="Obrir menú">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Enllaços -->
        <div class="collapse navbar-collapse" id="mainNavbar">

            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">
                        Inici
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/parcs') }}">
                        Parcs
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/veterinaris') }}">
                        Veterinaris
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/adopcions') }}">
                        Adopcions
                    </a>
                </li>

            </ul>

            <!-- Botons d'autenticació -->
            <div class="d-flex gap-2 align-items-center">

                @auth
                    <a href="{{ url('/perfil') }}" class="btn btn-outline-pawcare">
                        <i class="bi bi-person-circle me-1"></i>
                        El meu perfil
                    </a>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-pawcare">
                            Tancar sessió
                        </button>
                    </form>
                @else
                    <a href="{{ url('/login') }}" class="btn btn-outline-pawcare">
                        Iniciar sessió
                    </a>

                    <a href="{{ url('/register') }}" class="btn btn-pawcare">
                        Registrar-se
                    </a>
                @endauth

            </div>

        </div>
    </div>
</nav>

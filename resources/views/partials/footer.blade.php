
<footer class="pawcare-footer">
    <div class="container py-5">

        <div class="row g-4">

            <!-- Informació -->
            <div class="col-lg-5">
                <a href="{{ url('/') }}" class="pawcare-brand footer-brand">
                    <i class="bi bi-heart-fill"></i>
                    PawCare<span>.</span>
                </a>

                <p class="footer-description mt-3">
                    Cuidem dels nostres millors amics.
                    Descobreix serveis, cuida del teu gos
                    i ajuda altres animals a trobar una llar.
                </p>
            </div>

            <!-- Navegació -->
            <div class="col-6 col-lg-3">
                <h5>Explora</h5>

                <ul class="footer-links">
                    <li><a href="{{ url('/') }}">Inici</a></li>
                    <li><a href="{{ url('/parcs') }}">Parcs</a></li>
                    <li><a href="{{ url('/veterinaris') }}">Veterinaris</a></li>
                    <li><a href="{{ url('/adopcions') }}">Adopcions</a></li>
                </ul>
            </div>

            <!-- Compte -->
            <div class="col-6 col-lg-4">
                <h5>El teu compte</h5>

                <ul class="footer-links">
                    <li><a href="{{ url('/login') }}">Iniciar sessió</a></li>
                    <li><a href="{{ url('/register') }}">Crear compte</a></li>
                </ul>
            </div>

        </div>

        <hr class="footer-divider">

        <div class="d-flex flex-column flex-md-row justify-content-between gap-2">
            <p class="mb-0">
                © {{ date('Y') }} PawCare. Tots els drets reservats.
            </p>

            <p class="mb-0">
                Fet amb <i class="bi bi-heart-fill text-pawcare"></i>
                per als nostres millors amics.
            </p>
        </div>

    </div>
</footer>

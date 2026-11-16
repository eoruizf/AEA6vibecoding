
@extends('layouts.app')

@section('title', 'Inici')

@section('content')

    <!-- HERO -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-lg-6 hero-content">

                <span class="hero-label">
                    <i class="bi bi-paw-fill me-2"></i>
                    Benvinguts a PawCare
                </span>

                    <h1>
                        Tot el que necessita
                        el teu <span>millor amic.</span>
                    </h1>

                    <p>
                        Descobreix parcs, troba centres veterinaris,
                        gestiona la informació del teu gos i ajuda
                        altres animals a trobar una nova família.
                    </p>

                    <div class="d-flex flex-wrap gap-3 mt-4">
                        <a href="{{ url('/parcs') }}" class="btn btn-pawcare btn-lg">
                            Explorar serveis
                            <i class="bi bi-arrow-right ms-2"></i>
                        </a>

                        <a href="{{ url('/adopcions') }}"
                           class="btn btn-outline-pawcare btn-lg">
                            Adoptar un gos
                        </a>
                    </div>

                </div>

                <div class="col-lg-6 mt-5 mt-lg-0">
                    <div class="hero-image">
                        <div class="hero-image-content">
                            <i class="bi bi-heart-fill"></i>
                            <span>El seu benestar, la nostra prioritat</span>
                        </div>

                        <div class="hero-dog">
                            <i class="bi bi-stars"></i>
                            <span>🐶</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- SERVEIS -->
    <section class="services-section section-padding">
        <div class="container">

            <div class="section-heading text-center">
                <span>QUÈ T'OFERIM?</span>
                <h2>Tot en un mateix lloc</h2>
                <p>
                    Tot el que necessites per cuidar i protegir
                    el teu millor amic.
                </p>
            </div>

            <div class="row g-4 mt-3">

                <!-- Parcs -->
                <div class="col-md-4">
                    <div class="service-card">
                        <div class="service-icon icon-green">
                            <i class="bi bi-tree-fill"></i>
                        </div>

                        <h4>Parcs per a gossos</h4>

                        <p>
                            Descobreix espais on el teu gos
                            pot passejar, jugar i gaudir.
                        </p>

                        <a href="{{ url('/parcs') }}">
                            Descobrir parcs
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Veterinaris -->
                <div class="col-md-4">
                    <div class="service-card">
                        <div class="service-icon icon-orange">
                            <i class="bi bi-hospital-fill"></i>
                        </div>

                        <h4>Centres veterinaris</h4>

                        <p>
                            Troba professionals que vetllin
                            per la salut del teu animal.
                        </p>

                        <a href="{{ url('/veterinaris') }}">
                            Veure veterinaris
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Adopcions -->
                <div class="col-md-4">
                    <div class="service-card">
                        <div class="service-icon icon-pink">
                            <i class="bi bi-heart-fill"></i>
                        </div>

                        <h4>Adopcions</h4>

                        <p>
                            Ajuda un gos a trobar una família
                            que li doni una nova oportunitat.
                        </p>

                        <a href="{{ url('/adopcions') }}">
                            Veure adopcions
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- CRIDA A L'ACCIÓ -->
    <section class="cta-section">
        <div class="container text-center">
            <i class="bi bi-paw-fill cta-icon"></i>

            <h2>Forma part de la família PawCare</h2>

            <p>
                Crea el teu compte i comença a gestionar
                la cura dels teus millors amics.
            </p>

            <a href="{{ url('/register') }}" class="btn btn-light btn-lg">
                Uneix-te a PawCare
                <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
    </section>

@endsection

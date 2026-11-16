
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'PawCare') | Cuidem dels nostres millors amics</title>

    <meta name="description"
          content="PawCare: plataforma per gestionar els teus gossos i descobrir parcs, veterinaris i adopcions.">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
          rel="stylesheet">

    <!-- CSS propi -->
    <link rel="stylesheet" href="{{ asset('css/pawcare.css') }}">

    @stack('styles')
</head>

<body>

<!-- Navegació -->
@include('partials.navbar')

<!-- Contingut principal -->
<main>
    @yield('content')
</main>

<!-- Peu de pàgina -->
@include('partials.footer')

<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@stack('scripts')

</body>
</html>

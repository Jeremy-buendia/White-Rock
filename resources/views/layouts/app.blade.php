<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>White Rock</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Text:ital@0;1&display=swap" rel="stylesheet">
    <!-- Incluir Bootstrap CSS -->
    @vite(['resources/js/confirmar_eliminar.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <header class="bg-light py-3">
        <div class="container header-container">
            <a href="{{ url('/') }}">
                <h1>White Rock</h1>
            </a>
            <nav>
                <a href="{{ route('inmuebles.index') }}">Inmuebles</a>
                <a href="{{ route('perfil') }}">Perfil</a>
            </nav>
        </div>
    </header>

    <main class="d-flex">
        @yield('content')
    </main>

    <footer>
        <div class="container">
            <a href="#" id="volverArriba">Volver arriba</a>
            <br>
            <nav>
                <a href="{{ route('agente.login') }}">Acceso Agentes</a>
                <a href="{{ route('about') }}">Sobre Nosotros</a>
                <a href="{{ route('contacto') }}">Contacto</a>
            </nav>
            <br>
            <p>© 2025 White Rock. Todos los derechos reservados.</p>
        </div>
    </footer>

    <!-- Incluir Bootstrap JS y dependencias -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>
</body>

</html>

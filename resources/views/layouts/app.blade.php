<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DINAMICO</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Text:ital@0;1&display=swap" rel="stylesheet">
    <!-- Incluir Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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

    <footer class="bg-light py-3">
        <div class="container">
            <a href="#" id="volverArriba">Volver arriba</a>
            <br>
            <nav>
                <a href="{{ route('agente.login') }}">Acceso Agentes</a>
                <a href="#">Sobre Nosotros</a>
                <a href="#">Contacto</a>
            </nav>
            <br>
            <p>© 2025 White Rock. Todos los derechos reservados.</p>
        </div>
    </footer>

    <!-- Incluir Bootstrap JS y dependencias -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

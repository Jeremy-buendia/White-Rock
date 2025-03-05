<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DINAMICO</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Text:ital@0;1&display=swap" rel="stylesheet">
</head>

<body>
    <header>

        <a href="#">
            <h1>White Rock</h1>
        </a>
        <nav>
            <a href="#">Inmuebles</a>
            <a href="#">Perfil</a>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <a href="#" id="volverArriba">Volver arriba</a>
        <br>
        <nav>
            <a href="/agente/login">Acceso Agentes</a>
            <a href="#">Sobre Nosotros</a>
            <a href="#">Contacto</a>
        </nav>
        <br>
        <p>© 2025 White Rock. Todos los derechos reservados.</p>
    </footer>

</body>

</html>

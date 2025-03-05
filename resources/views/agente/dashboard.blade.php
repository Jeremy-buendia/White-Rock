<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Panel de Agente</title>
    <link href="{{ asset('css/agente.css') }}" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Text:ital@0;1&display=swap" rel="stylesheet">
</head>

<body>

    <header>
        <h4>White Rock</h4>
    </header>

    <main class="contenedor">
        <aside>
            <h3>Ver próximas visitas</h3>
        </aside>
        <section>
            <div class="inmuebles">
                <div class="mini-header">
                    <h3>Ver inmuebles</h3>
                    <a href="{{ route('agente.crear_inmueble') }}">Añadir Inmueble</a>
                </div>

            </div>
            <div class="visitas">
                <div class="mini-header">
                    <h3>Visitas</h3>
                    <a href="#">Crear nueva visita</a>
                </div>
            </div>
            <div class="contratos">
                <div class="mini-header">
                    <h3>Contratos</h3>
                    <a href="#">Crear nuevo contrato</a>
                </div>
            </div>
            <div class="transacciones">
                <div class="mini-header">
                    <h3>Transacciones</h3>
                    <a href="#">Enlace Transacciones</a>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <p>© 2025 White Rock. Todos los derechos reservados.</p>
    </footer>
</body>

</html>

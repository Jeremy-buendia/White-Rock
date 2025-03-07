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
                    {{ $inmuebles->links() }} <!-- Para mostrar los enlaces de paginación -->
                </div>

                <div class>
                    @foreach ($inmuebles as $inmueble)
                        <div class="item">
                            <div class="datos">
                                <h2>{{ $inmueble->nombre }}</h2>
                                <p><b>Dirección: </b>{{ $inmueble->direccion }}</p>
                                <p><b>Precio: </b>{{ $inmueble->precio }}</p>
                                <p>{{ $inmueble->tamano }} metros cuadrados</p>
                            </div>

                            <div class="btnItem">
                                <a href="" class="btn">Editar</a>
                                <a href="" class="btn">Eliminar</a>
                            </div>
                        </div>
                    @endforeach
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

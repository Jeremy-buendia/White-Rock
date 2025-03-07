<x-agente-layout>
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

                <div>
                    @foreach ($inmuebles as $inmueble)
                        <div class="item">
                            <div class="datos">
                                <h2><a
                                        href="{{ route('agente.ver_inmueble', $inmueble->id) }}">{{ $inmueble->nombre }}</a>
                                </h2>
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
                    <div class="d-flex mx-5">
                        {{ $inmuebles->links('pagination::bootstrap-5') }}
                    </div> <!-- Para mostrar los enlaces de paginación -->
                </div>

            </div>
            <div class="visitas">
                <div class="mini-header">
                    <h3>Solicitudes de Visita</h3>
                    <a href="{{ route('agente.solicitar_visita') }}">Crear nueva visita</a>
                </div>

                <div>
                    @foreach ($visitas as $visita)
                        <div class="item">
                            <div class="datos">
                                <h2><a href="">{{ $visita->fecha_propuesta }}</a></h2>
                                <p><b>Nombre: </b>{{ $visita->user->name }} {{ $visita->user->apellido }}</p>
                                <p><b>Email: </b>{{ $visita->user->email }}</p>
                                <p><b>Teléfono: </b>{{ $visita->user->telefono }}</p>
                            </div>

                            <div class="btnItem">
                                <a href="" class="btn">Editar</a>
                                <a href="" class="btn">Eliminar</a>
                            </div>
                        </div>
                    @endforeach
                    <div class="d-flex mx-5">
                        {{ $inmuebles->links('pagination::bootstrap-5') }}
                    </div> <!-- Para mostrar los enlaces de paginación -->
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
</x-agente-layout>

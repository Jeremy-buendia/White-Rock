<x-agente-layout>
    <main class="contenedor">
        <aside>
            <div class="mini-header">
                <h3>Próximas Visitas</h3>
                <a href="{{ route('agente.solicitar_visita') }}">Crear nueva visita</a>
            </div>
            @foreach ($visitas as $visita)
                <div class="item">
                    <div class="datos">
                        <h2><a href="">{{ $visita->fecha_propuesta }}</a></h2>
                        <p><b>Nombre: </b>{{ $visita->user->name }} {{ $visita->user->apellido }}</p>
                        <p><b>Email: </b>{{ $visita->user->email }}</p>
                        <p><b>Teléfono: </b>{{ $visita->user->telefono }}</p>
                    </div>

                    <div class="btnItem">
                        <a href="{{ route('visita.editar', $visita->id) }}" class="btn">Editar</a>
                        <form action="{{ route('visita.destroy', $visita->id) }}" method="POST"
                            onsubmit="confirmarEliminacion(event)">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn">Eliminar</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </aside>
        <section>
            <div class="inmuebles">
                <div class="mini-header">
                    <h3>Ver inmuebles</h3>
                    <a href="{{ route('agente.crearInmueble') }}">Añadir Inmueble</a>
                </div>

                <div>
                    @foreach ($inmuebles as $inmueble)
                        <div class="item">
                            <div class="datos">
                                <h2><a
                                        href="{{ route('agente.ver_inmueble', $inmueble->id) }}">{{ $inmueble->nombre }}</a>
                                </h2>
                                <p><b>Dirección: </b>{{ $inmueble->direccion }}</p>
                                <p><b>Precio: </b>{{ $inmueble->precio }}€</p>
                                <p><b>Dimensiones: </b>{{ $inmueble->tamano }} metros cuadrados</p>
                            </div>

                            <div class="btnItem">
                                <a href="{{ route('inmueble.editar', $inmueble->id) }}" class="btn">Editar</a>
                                <form action="{{ route('inmueble.destroy', $inmueble->id) }}" method="POST"
                                    onsubmit="confirmarEliminacion(event)">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn">Eliminar</button>
                                </form>
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
                </div>

                <div>
                    @foreach ($solicitudVisitas as $solicitudVisita)
                        <div class="item">
                            <div class="datos">
                                <h2><a href="">{{ $solicitudVisita->fecha_propuesta }}</a></h2>
                                <p><b>Nombre: </b>{{ $solicitudVisita->user->name }}
                                    {{ $solicitudVisita->user->apellido }}</p>
                                <p><b>Email: </b>{{ $solicitudVisita->user->email }}</p>
                                <p><b>Teléfono: </b>{{ $solicitudVisita->user->telefono }}</p>
                            </div>

                            <div class="btnItem">
                                <a href="{{ route('visita.editar', $solicitudVisita->id) }}" class="btn">Editar</a>
                                <form action="{{ route('visita.destroy', $solicitudVisita->id) }}" method="POST"
                                    onsubmit="confirmarEliminacion(event)">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn">Eliminar</button>
                                </form>
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

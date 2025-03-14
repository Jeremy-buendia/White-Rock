<x-agente-layout>
    <main class="contenedor container-fluid">
        <a href="/agente/solicitudes" class="prox-visitas">Ver Próximas visitas</a>
        <aside>
            <div class="mini-header">
                <h3>Próximas Visitas</h3>
                <a href="{{ route('agente.solicitar_visita') }}">Crear nueva visita</a>
            </div>

            @foreach ($visitas as $visita)
                <div class="item">
                    <div class="datos">
                        <h2>{{ $visita->fecha_propuesta }}</h2>
                        <p><b>Nombre: </b>{{ $visita->user->name }} {{ $visita->user->apellido }}</p>
                        <p><b>Email: </b>{{ $visita->user->email }}</p>
                        <p><b>Teléfono: </b>{{ $visita->user->telefono }}</p>
                        <p><b>Nombre Propiedad: </b> {{ $visita->propiedad->nombre }}</p>
                        <p><b>Direccion: </b> {{ $visita->propiedad->direccion }}</p>
                    </div>

                    <div class="btnItem">
                        <a href="{{ route('visita.editar', $visita->id) }}" class="btn btn-primary">Editar</a>
                        <form action="{{ route('visita.destroy', $visita->id) }}" method="POST"
                            onsubmit="confirmarEliminacion(event)">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger">Eliminar</button>
                        </form>
                    </div>
                </div>
            @endforeach

            @if (count($visitas) == 0)
                <p>No hay próximas visitas</p>
            @endif

            @if (count($visitas) >= 2)
                <a href="/agente/solicitudes">Ver todas</a>
            @endif
        </aside>
        <section>
            <div class="inmuebles">
                <div class="mini-header">
                    <h3>Ver inmuebles</h3>
                    <a href="{{ route('agente.crearInmueble') }}">Añadir Inmueble</a>
                </div>

                <div class="items">
                    @foreach ($inmuebles as $inmueble)
                        <div class="item">
                            <div class="datos">
                                <h2 class="truncate"><a
                                        href="{{ route('agente.ver_inmueble', $inmueble->id) }}">{{ $inmueble->nombre }}</a>
                                </h2>
                                <p><b>Dirección: </b>{{ $inmueble->direccion }}</p>
                                <p><b>Precio: </b>{{ $inmueble->precio }}€</p>
                                <p><b>Dimensiones: </b>{{ $inmueble->tamano }} m²</p>
                            </div>

                            <div class="btnItem">
                                <a href="{{ route('inmueble.editar', $inmueble->id) }}"
                                    class="btn btn-primary">Editar</a>
                                <form action="{{ route('inmueble.destroy', $inmueble->id) }}" method="POST"
                                    onsubmit="confirmarEliminacion(event)">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    @endforeach

                    @if (count($inmuebles) == 0)
                        <p>No hay inmuebles</p>
                    @endif
                </div>
                <div class="d-flex mx-5">
                    {{ $inmuebles->links('pagination::bootstrap-5') }}
                </div> <!-- Para mostrar los enlaces de paginación -->

            </div>
            <div class="solicitudVisitas">
                <div class="mini-header">
                    <h3>Solicitudes de Visita</h3>
                </div>

                <div class="items">
                    @foreach ($solicitudVisitas as $solicitudVisita)
                        <div class="item">
                            <div class="datos">
                                <h2>{{ $solicitudVisita->fecha_propuesta }}</h2>
                                <p><b>Nombre: </b>{{ $solicitudVisita->user->name }}
                                    {{ $solicitudVisita->user->apellido }}</p>
                                <p><b>Email: </b>{{ $solicitudVisita->user->email }}</p>
                                <p><b>Teléfono: </b>{{ $solicitudVisita->user->telefono }}</p>
                                <p><b>Nombre Propiedad: </b> {{ $solicitudVisita->propiedad->nombre }}</p>
                                <p><b>Direccion: </b> {{ $solicitudVisita->propiedad->direccion }}</p>
                            </div>

                            <div class="btnItem">
                                <a href="{{ route('visita.aceptar', $solicitudVisita->id) }}"
                                    class="btn btn-outline-success">Aprobar</a>
                                <form action="{{ route('visita.destroy', $solicitudVisita->id) }}" method="POST"
                                    onsubmit="confirmarEliminacion(event)">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    @endforeach

                    @if (count($solicitudVisitas) == 0)
                        <p>No hay solicitudes de visita</p>
                    @endif
                </div>
                <div class="d-flex mx-5">
                    {{ $solicitudVisitas->links('pagination::bootstrap-5') }}
                </div> <!-- Para mostrar los enlaces de paginación -->
            </div>
            <div class="contratos">
                <div class="mini-header">
                    <h3>Contratos</h3>
                </div>
                <a href="{{ route('contrato.crear') }}">Crear nuevo contrato</a>
                <a href="{{ route('contrato.index_all') }}">Ver contratos</a>
            </div>
            <div class="transacciones">
                <div class="mini-header">
                    <h3>Transacciones</h3>
                </div>
                <a href="{{ route('transaccion.crear') }}">Crear Transacción</a>
                <a href="{{ route('transaccion.index_all') }}">Ver transacciones</a>
            </div>
        </section>
    </main>
</x-agente-layout>

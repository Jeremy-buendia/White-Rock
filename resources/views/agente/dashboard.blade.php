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

                <div class>
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
</x-agente-layout>

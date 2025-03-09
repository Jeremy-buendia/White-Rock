<x-agente-layout>
    <main>
        <a href="" class="prox-visitas">Ver Próximas visitas</a>
        <div class="mini-header">
            <h3>Próximas Visitas</h3>
            <a href="{{ route('agente.solicitar_visita') }}">Crear nueva visita</a>
        </div>

        <div class="contenedor-unico">
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
        </div>
    </main>
</x-agente-layout>

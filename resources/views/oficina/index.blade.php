<x-agente-layout>
    <main class="">
        <nav>
            <ul>
                <li> {{ $oficina->nombre }}</li>
                <li> {{ $oficina->direccion }}</li>
                <li> {{ $oficina->telefono }}</li>
                <li> {{ $oficina->fax }}</li>
            </ul>
        </nav>
        <a href="{{ route('oficina.crear') }}">Crear Oficina</a>
        <a href="{{ route('oficina.editar', $oficina->id) }}">Editar</a>
    </main>
</x-agente-layout>

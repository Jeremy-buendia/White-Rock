<x-agente-layout>
    <main class="contenedor">
        <h1>{{ $propiedad->nombre }}</h1>

        <br>
        @foreach ($imagenes as $imagen)
            <img src="{{ Storage::url($imagen->url_fotografia) }}" alt="{{ $imagen->descripcion }}">
        @endforeach
    </main>
</x-agente-layout>

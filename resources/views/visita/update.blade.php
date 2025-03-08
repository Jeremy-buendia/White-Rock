<x-agente-layout>
    <main class="">
        <form method="POST" action="{{ route('visita.editar', $solicitudVisita->id) }}">
            @csrf
            @method('PUT')

            <!-- Correo Electrónico -->
            <div>
                <x-input-label for="correo_electronico" :value="__('Correo Electrónico: ')" />
                <x-text-input id="correo_electronico" type="email" name="correo_electronico" value="{{ $emailCliente }}"
                    required autofocus autocomplete="correo_electronico" />
                <x-input-error :messages="$errors->get('correo_electronico')" class="mt-2" />
            </div>

            <!-- Propiedad -->
            <div>
                <x-input-label for="propiedad_id" :value="__('Propiedad: ')" />

                <select id="propiedad_id" name="propiedad_id"
                    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @foreach ($propiedades as $propiedad)
                        <option value="{{ $propiedad->id }}" @if ($propiedad->id == $propiedadVisita->id) selected @endif>
                            {{ $propiedad->nombre }}</option>
                    @endforeach
                </select>

                <x-input-error :messages="$errors->get('propiedad_id')" class="mt-2" />
            </div>

            <!-- Fecha Propuesta -->

            <div>
                <x-input-label for="fecha_propuesta" :value="__('Fecha y Hora: ')" />
                <x-text-input id="fecha_propuesta" type="datetime-local" name="fecha_propuesta"
                    value="{{ $solicitudVisita->fecha_propuesta }}" required autocomplete="fecha_propuesta" />
                <x-input-error :messages="$errors->get('fecha_propuesta')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="estado" :value="__('Estado: ')" />

                <select id="estado" name="estado"
                    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="pendiente" @if ($solicitudVisita->estado == 'pendiente') selected @endif>Pendiente</option>
                    <option value="aprobada" @if ($solicitudVisita->estado == 'aprobada') selected @endif>Aprobada</option>
                    <option value="rechazada" @if ($solicitudVisita->estado == 'rechazada') selected @endif>Rechazada</option>
                </select>

                <x-input-error :messages="$errors->get('tipo_propiedad')" class="mt-2" />
            </div>

            <div class="">
                <x-primary-button class="ms-4">
                    {{ __('Establecer Visita') }}
                </x-primary-button>
            </div>

            <div class="">
                <a href="{{ route('agente.dashboard') }}">Volver</a>
            </div>
        </form>
    </main>
</x-agente-layout>

<x-agente-layout>
    <main class="">
        <form method="POST" action="{{ route('agente.solicitar_visita') }}" enctype='multipart/form-data'>
            @csrf

            <!-- Correo Electrónico -->
            <div>
                <x-input-label for="correo_electronico" :value="__('Correo Electrónico: ')" />
                <x-text-input id="correo_electronico" type="email" name="correo_electronico" :value="old('correo_electronico')" required
                    autofocus autocomplete="correo_electronico" />
                <x-input-error :messages="$errors->get('correo_electronico')" class="mt-2" />
            </div>

            <!-- Propiedad -->
            <div>
                <x-input-label for="propiedad_id" :value="__('Propiedad: ')" />

                <select id="propiedad_id" name="propiedad_id"
                    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @foreach ($propiedades as $propiedad)
                        <option value="{{ $propiedad->id }}">{{ $propiedad->nombre }}</option>
                    @endforeach
                </select>

                <x-input-error :messages="$errors->get('propiedad_id')" class="mt-2" />
            </div>

            <!-- Fecha Propuesta -->

            <div>
                <x-input-label for="fecha_propuesta" :value="__('Fecha y Hora: ')" />
                <x-text-input id="fecha_propuesta" type="datetime-local" name="fecha_propuesta" :value="old('fecha_propuesta')"
                    required autocomplete="fecha_propuesta" />
                <x-input-error :messages="$errors->get('fecha_propuesta')" class="mt-2" />
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

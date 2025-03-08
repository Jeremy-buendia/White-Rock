<x-agente-layout>
    <main class="">
        <form method="POST" action="{{ route('contrato.store') }}">
            @csrf

            <!-- Correo Electrónico -->
            <div>
                <x-input-label for="correo_electronico" :value="__('Correo Electrónico Postor: ')" />
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

            <div>
                <x-input-label for="tipo_contrato" :value="__('Tipo de Contrato: ')" />

                <select id="tipo_contrato" name="tipo_contrato" class="" onchange="habilitarDeshabilitarCampo()">
                    <option value="compra" {{ old('tipo_contrato') == 'compra' ? 'selected' : '' }}>Compra</option>
                    <option value="venta" {{ old('tipo_contrato') == 'venta' ? 'selected' : '' }}>Venta</option>
                    <option value="alquiler" {{ old('tipo_contrato') == 'alquiler' ? 'selected' : '' }}>Alquiler
                    </option>
                </select>

                <x-input-error :messages="$errors->get('estado')" class="mt-2" />
            </div>

            <!-- Fecha Inicio -->

            <div>
                <x-input-label for="fecha_inicio" :value="__('Fecha de Incio: ')" />
                <x-text-input id="fecha_inicio" type="date" name="fecha_inicio" :value="old('fecha_inicio')" required
                    autocomplete="fecha_inicio" />
                <x-input-error :messages="$errors->get('fecha_inicio')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="fecha_finalizacion" :value="__('Fecha de Finalización: ')" />
                <x-text-input id="fecha_finalizacion" type="date" name="fecha_finalizacion" :value="old('fecha_finalizacion')"
                    autocomplete="fecha_finalizacion" />
                <x-input-error :messages="$errors->get('fecha_finalizacion')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="condiciones" :value="__('Condiciones: ')" />

                <textarea name="condiciones" id="condiciones" rows="4" cols="50">{{ old('condiciones') }}</textarea>

                <x-input-error :messages="$errors->get('condiciones')" class="mt-2" />
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

        <script>
            function habilitarDeshabilitarCampo() {
                const select = document.getElementById('tipo_contrato');
                const campo = document.getElementById('fecha_finalizacion');

                if (select.value === 'alquiler') { // Reemplaza 'opcion2' con el valor que desees
                    campo.disabled = false;
                    campo.required = true; // Habilita el campo
                } else {
                    campo.disabled = true;
                    campo.required = false; // Deshabilita el campo
                }
            }

            // Ejecutar la función al cargar la página para establecer el estado inicial
            habilitarDeshabilitarCampo();
        </script>
    </main>
</x-agente-layout>

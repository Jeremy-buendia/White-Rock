<x-agente-layout>
    <main class="container-lg">
        <h1 class="mt-4 mb-4">Crear Contrato</h1>
        <form method="POST" action="{{ route('contrato.store') }}" class="row g-3">
            @csrf

            <!-- Correo Electrónico -->
            <div class="col-md-6">
                <x-input-label for="correo_electronico" class="form-label" :value="__('Correo Electrónico Postor: ')" />
                <x-text-input id="correo_electronico" class="form-control" type="email" name="correo_electronico"
                    :value="old('correo_electronico')" required autofocus autocomplete="correo_electronico" />
                <x-input-error :messages="$errors->get('correo_electronico')" class="invalid-feedback d-block" />
            </div>

            <!-- Propiedad -->
            <div class="col-md-6">
                <x-input-label for="propiedad_id" class="form-label" :value="__('Propiedad: ')" />
                <select id="propiedad_id" name="propiedad_id" class="form-select">
                    @foreach ($propiedades as $propiedad)
                        <option value="{{ $propiedad->id }}">{{ $propiedad->nombre }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('propiedad_id')" class="invalid-feedback d-block" />
            </div>

            <!-- Tipo de Contrato -->
            <div class="col-md-4">
                <x-input-label for="tipo_contrato" class="form-label" :value="__('Tipo de Contrato: ')" />
                <select id="tipo_contrato" name="tipo_contrato" class="form-select"
                    onchange="habilitarDeshabilitarCampo()">
                    <option value="compra" {{ old('tipo_contrato') == 'compra' ? 'selected' : '' }}>Compra</option>
                    <option value="venta" {{ old('tipo_contrato') == 'venta' ? 'selected' : '' }}>Venta</option>
                    <option value="alquiler" {{ old('tipo_contrato') == 'alquiler' ? 'selected' : '' }}>Alquiler
                    </option>
                </select>
                <x-input-error :messages="$errors->get('tipo_contrato')" class="invalid-feedback d-block" />
            </div>

            <!-- Fecha Inicio -->
            <div class="col-md-4">
                <x-input-label for="fecha_inicio" class="form-label" :value="__('Fecha de Inicio: ')" />
                <x-text-input id="fecha_inicio" class="form-control" type="date" name="fecha_inicio"
                    :value="old('fecha_inicio')" required autocomplete="fecha_inicio" />
                <x-input-error :messages="$errors->get('fecha_inicio')" class="invalid-feedback d-block" />
            </div>

            <!-- Fecha Finalización -->
            <div class="col-md-4">
                <x-input-label for="fecha_finalizacion" class="form-label" :value="__('Fecha de Finalización: ')" />
                <x-text-input id="fecha_finalizacion" class="form-control" type="date" name="fecha_finalizacion"
                    :value="old('fecha_finalizacion')" autocomplete="fecha_finalizacion" />
                <x-input-error :messages="$errors->get('fecha_finalizacion')" class="invalid-feedback d-block" />
            </div>

            <!-- Condiciones -->
            <div class="col-12">
                <x-input-label for="condiciones" class="form-label" :value="__('Condiciones: ')" />
                <textarea name="condiciones" id="condiciones" rows="4" class="form-control">{{ old('condiciones') }}</textarea>
                <x-input-error :messages="$errors->get('condiciones')" class="invalid-feedback d-block" />
            </div>

            <!-- Botones -->
            <div class="col-12">
                <x-primary-button class="btn btn-primary">
                    {{ __('Crear Contrato') }}
                </x-primary-button>
                <a href="{{ route('agente.dashboard') }}" class="btn btn-secondary">Volver</a>

            </div>
        </form>

        <script>
            function habilitarDeshabilitarCampo() {
                const select = document.getElementById('tipo_contrato');
                const campo = document.getElementById('fecha_finalizacion');

                if (select.value === 'alquiler') {
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

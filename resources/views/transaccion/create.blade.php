<x-agente-layout>
    <main class="container-lg">
        <h1 class="mt-4 mb-4">Registrar Transacción</h1>
        <form method="POST" action="{{ route('transaccion.store') }}" class="row g-3">
            @csrf

            <!-- Correo Electrónico -->
            <div class="col-md-6">
                <x-input-label for="correo_electronico" class="form-label" :value="__('Correo Electrónico Cliente: ')" />
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

            <!-- Tipo de Transacción -->
            <div class="col-md-6">
                <x-input-label for="tipo_transaccion" class="form-label" :value="__('Tipo de Transacción: ')" />
                <select id="tipo_transaccion" name="tipo_transaccion" class="form-select">
                    <option value="compra" {{ old('tipo_transaccion') == 'compra' ? 'selected' : '' }}>Compra</option>
                    <option value="venta" {{ old('tipo_transaccion') == 'venta' ? 'selected' : '' }}>Venta</option>
                    <option value="alquiler" {{ old('tipo_transaccion') == 'alquiler' ? 'selected' : '' }}>Alquiler
                    </option>
                </select>
                <x-input-error :messages="$errors->get('tipo_transaccion')" class="invalid-feedback d-block" />
            </div>

            <!-- Precio Transacción -->
            <div class="col-md-6">
                <x-input-label for="precio_transaccion" class="form-label" :value="__('Cantidad: ')" />
                <x-text-input id="precio_transaccion" class="form-control" type="text" name="precio_transaccion"
                    :value="old('precio_transaccion')" required autofocus autocomplete="precio_transaccion" />
                <x-input-error :messages="$errors->get('precio_transaccion')" class="invalid-feedback d-block" />
            </div>

            <!-- Botones -->
            <div class="col-12">
                <x-primary-button class="btn btn-primary">
                    {{ __('Registrar Transacción') }}
                </x-primary-button>

                <a href="{{ route('agente.dashboard') }}" class="btn btn-secondary">Volver</a>
            </div>
        </form>
    </main>
</x-agente-layout>

<x-agente-layout>
    <main class="">
        <form method="POST" action="{{ route('transaccion.store') }}">
            @csrf

            <!-- Correo Electrónico -->
            <div>
                <x-input-label for="correo_electronico" :value="__('Correo Electrónico Cliente: ')" />
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
                <x-input-label for="tipo_transaccion" :value="__('Tipo de Transacción: ')" />

                <select id="tipo_transaccion" name="tipo_transaccion" class="">
                    <option value="compra" {{ old('tipo_transaccion') == 'compra' ? 'selected' : '' }}>Compra</option>
                    <option value="venta" {{ old('tipo_transaccion') == 'venta' ? 'selected' : '' }}>Venta</option>
                    <option value="alquiler" {{ old('tipo_transaccion') == 'alquiler' ? 'selected' : '' }}>Alquiler
                    </option>
                </select>

                <x-input-error :messages="$errors->get('estado')" class="mt-2" />
            </div>

            <!-- Fecha Inicio -->

            <div>
                <x-input-label for="precio_transaccion" :value="__('Cantidad: ')" />
                <x-text-input id="precio_transaccion" type="text" name="precio_transaccion" :value="old('precio_transaccion')"
                    required autofocus autocomplete="precio_transaccion" />
                <x-input-error :messages="$errors->get('precio_transaccion')" class="mt-2" />
            </div>

            <div class="">
                <x-primary-button class="ms-4">
                    {{ __('Registrar Transacción') }}
                </x-primary-button>
            </div>

            <div class="">
                <a href="{{ route('agente.dashboard') }}">Volver</a>
            </div>
        </form>
    </main>
</x-agente-layout>

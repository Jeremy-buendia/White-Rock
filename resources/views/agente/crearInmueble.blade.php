<x-guest-layout>
    <form method="POST" action="{{ route('agente.crear_inmueble') }}">
        @csrf

        <!-- Dirección -->
        <div>
            <x-input-label for="direccion" :value="__('Dirección: ')" />
            <x-text-input id="direccion" class="block mt-1 w-full" type="text" name="direccion" :value="old('direccion')"
                required autofocus autocomplete="direccion" />
            <x-input-error :messages="$errors->get('direccion')" class="mt-2" />
        </div>

        <!-- Tipo de propiedad -->
        <div class="mt-4">
            <x-input-label for="tipo_propiedad" :value="__('Tipo de Propiedad: ')" />
            <x-text-input id="tipo_propiedad" class="block mt-1 w-full" type="text" name="tipo_propiedad"
                :value="old('tipo_propiedad')" required autocomplete="tipo_propiedad" />
            <x-input-error :messages="$errors->get('tipo_propiedad')" class="mt-2" />
        </div>

        <!-- Precio -->
        <div class="mt-4">
            <x-input-label for="precio" :value="__('Precio: ')" />
            <x-text-input id="precio" class="block mt-1 w-full" type="email" name="precio" :value="old('precio')"
                required autocomplete="precio" />
            <x-input-error :messages="$errors->get('precio')" class="mt-2" />
        </div>

        <!-- Tamaño -->
        <div class="mt-4">
            <x-input-label for="tamano" :value="__('Tamaño: ')" />
            <x-text-input id="tamano" class="block mt-1 w-full" type="text" name="tamano" :value="old('tamano')"
                required autocomplete="tamano" />
            <x-input-error :messages="$errors->get('tamano')" class="mt-2" />
        </div>

        <!-- Dirección -->
        <div class="mt-4">
            <x-input-label for="direccion" :value="__('Dirección: ')" />
            <x-text-input id="direccion" class="block mt-1 w-full" type="text" name="direccion" :value="old('direccion')"
                required autocomplete="direccion" />
            <x-input-error :messages="$errors->get('direccion')" class="mt-2" />
        </div>

        <!-- Estado -->
        <div class="mt-4">
            <x-input-label for="estado" :value="__('Dirección: ')" />
            <x-text-input id="estado" class="block mt-1 w-full" type="text" name="estado" :value="old('estado')"
                required autocomplete="estado" />
            <x-input-error :messages="$errors->get('estado')" class="mt-2" />
        </div>

        <!-- Descripción -->
        <div class="mt-4">
            <x-input-label for="descripcion" :value="__('Descripción: ')" />

            <textarea name="descripcion" id="descripcion" rows="4" cols="50">{{ old('descripcion') }}</textarea>

            <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                {{ __('Añadir Inmueble') }}
            </x-primary-button>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a href="{{ route('agente.dashboard') }}">Volver</a>
        </div>
    </form>
</x-guest-layout>

<x-agente-layout>
    <form method="POST" action="{{ route('inmueble.actualizar', $inmueble->id) }}">
        @csrf
        <h3>Editar Inmueble</h3>
        <br>
        <!-- Correo Electrónico -->
        <div class="mt-4">
            <x-input-label for="nombre" :value="__('Correo Electrónico:')" />
            <x-text-input id="nombre" class="block mt-1 w-full" type="text" name="nombre"
                value="{{ $inmueble->nombre }}" required />
            <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
        </div>
        <br>

        <div class="mt-4">
            <x-input-label for="direccion" :value="__('direccion:')" />
            <x-text-input id="direccion" class="block mt-1 w-full" type="text" name="direccion"
                value="{{ $inmueble->direccion }}" required />
            <x-input-error :messages="$errors->get('direccion')" class="mt-2" />
        </div>
        <br>

        <div>
            <x-input-label for="tipo_propiedad" :value="__('Tipo de Propiedad: ')" />

            <select id="tipo_propiedad" name="tipo_propiedad"
                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option value="casa" @if ($inmueble->tipo_propiedad == 'casa') selected @endif>Casa</option>
                <option value="apartamento" @if ($inmueble->tipo_propiedad == 'apartamento') selected @endif>Apartamento</option>
                <option value="terreno" @if ($inmueble->tipo_propiedad == 'terreno') selected @endif>Terreno</option>
            </select>

            <x-input-error :messages="$errors->get('tipo_propiedad')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="precio" :value="__('Precio:')" />
            <x-text-input id="precio" class="block mt-1 w-full" type="text" name="precio"
                value="{{ $inmueble->precio }}" required />
            <x-input-error :messages="$errors->get('precio')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="tamano" :value="__('Tamaño:')" />
            <x-text-input id="tamano" class="block mt-1 w-full" type="text" name="tamano"
                value="{{ $inmueble->tamano }}" required />
            <x-input-error :messages="$errors->get('tamano')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="descripcion" :value="__('Descripción: ')" />

            <textarea name="descripcion" id="descripcion" rows="4" cols="50">{{ $inmueble->descripcion }}</textarea>

            <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="estado" :value="__('Estado: ')" />

            <select id="estado" name="estado"
                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option value="disponible" @if ($inmueble->tipo_propiedad == 'disponible') selected @endif>Disponible</option>
                <option value="vendido" @if ($inmueble->tipo_propiedad == 'vendido') selected @endif>Vendido</option>
                <option value="alquilado" @if ($inmueble->tipo_propiedad == 'alquilado') selected @endif>Alquilado</option>
            </select>

            <div class="form-group">
                <label for="imagenes">Selecciona las imágenes:</label>
                <input type="file" class="form-control" id="imagenes" name="imagenes[]"
                    accept=".jpg,.jpeg,.png,.svg" multiple>
            </div>

            <!--Posible traspaso a oficina-->
            <x-input-error :messages="$errors->get('tipo_propiedad')" class="mt-2" />
        </div>

        <!-- Botón de Registro -->
        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4 iniciar-sesion">
                {{ __('Iniciar Sesión') }}
            </x-primary-button>
        </div>
    </form>
</x-agente-layout>

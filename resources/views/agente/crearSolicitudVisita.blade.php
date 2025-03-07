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

            <!-- Tipo de propiedad -->
            <div>
                <x-input-label for="tipo_propiedad" :value="__('Tipo de Propiedad: ')" />

                <select id="tipo_propiedad" name="tipo_propiedad"
                    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="casa" {{ old('tipo_propiedad') == 'casa' ? 'selected' : '' }}>Casa</option>
                    <option value="apartamento" {{ old('tipo_propiedad') == 'apartamento' ? 'selected' : '' }}>
                        Apartamento
                    </option>
                    <option value="terreno" {{ old('tipo_propiedad') == 'terreno' ? 'selected' : '' }}>Terreno</option>
                </select>

                <x-input-error :messages="$errors->get('tipo_propiedad')" class="mt-2" />
            </div>

            <!-- Precio -->
            <div>
                <x-input-label for="precio" :value="__('Precio: ')" />
                <x-text-input id="precio" type="text" name="precio" :value="old('precio')" required
                    autocomplete="precio" />
                <x-input-error :messages="$errors->get('precio')" class="mt-2" />
            </div>

            <!-- Tamaño -->
            <div>
                <x-input-label for="tamano" :value="__('Tamaño: ')" />
                <x-text-input id="tamano" type="text" name="tamano" :value="old('tamano')" required
                    autocomplete="tamano" />
                <x-input-error :messages="$errors->get('tamano')" class="mt-2" />
            </div>

            <!-- Dirección -->
            <div>
                <x-input-label for="direccion" :value="__('Dirección: ')" />
                <x-text-input id="direccion" class="" type="text" name="direccion" :value="old('direccion')" required
                    autocomplete="direccion" />
                <x-input-error :messages="$errors->get('direccion')" class="mt-2" />
            </div>

            <!-- Estado -->
            <div>
                <x-input-label for="estado" :value="__('Estado: ')" />

                <select id="estado" name="estado" class="">
                    <option value="disponible" {{ old('estado') == 'disponible' ? 'selected' : '' }}>Disponible</option>
                    <option value="vendido" {{ old('estado') == 'vendido' ? 'selected' : '' }}>Vendido</option>
                    <option value="alquilado" {{ old('estado') == 'alquilado' ? 'selected' : '' }}>Alquilado</option>
                </select>

                <x-input-error :messages="$errors->get('estado')" class="mt-2" />
            </div>


            <!-- Descripción -->
            <div>
                <x-input-label for="descripcion" :value="__('Descripción: ')" />

                <textarea name="descripcion" id="descripcion" rows="4" cols="50">{{ old('descripcion') }}</textarea>

                <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
            </div>

            <div class="form-group">
                <label for="imagenes">Selecciona las imágenes:</label>
                <input type="file" class="form-control" id="imagenes" name="imagenes[]"
                    accept=".jpg,.jpeg,.png,.svg" multiple>
            </div>

            <div class="">
                <x-primary-button class="ms-4">
                    {{ __('Añadir Inmueble') }}
                </x-primary-button>
            </div>

            <div class="">
                <a href="{{ route('agente.dashboard') }}">Volver</a>
            </div>
        </form>
    </main>
</x-agente-layout>

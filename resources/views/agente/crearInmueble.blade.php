<x-agente-layout>
    <main class="container-lg">
        <h1 class="mt-4 mb-4">Crear Inmueble</h1>
        <form method="POST" action="{{ route('agente.crearInmueble') }}" enctype='multipart/form-data' class="row g-3">
            @csrf

            <!-- Nombre -->
            <div class="col-md-6">
                <x-input-label for="nombre" class="form-label" :value="__('Nombre: ')" />
                <x-text-input id="nombre" class="form-control" type="text" name="nombre" :value="old('nombre')"
                    required autofocus autocomplete="nombre" />
                <x-input-error :messages="$errors->get('nombre')" class="invalid-feedback d-block" />
            </div>

            <!-- Tipo de propiedad -->
            <div class="col-md-6">
                <x-input-label for="tipo_propiedad" class="form-label" :value="__('Tipo de Propiedad: ')" />
                <select id="tipo_propiedad" name="tipo_propiedad" class="form-select">
                    <option value="casa" {{ old('tipo_propiedad') == 'casa' ? 'selected' : '' }}>Casa</option>
                    <option value="apartamento" {{ old('tipo_propiedad') == 'apartamento' ? 'selected' : '' }}>
                        Apartamento
                    </option>
                    <option value="terreno" {{ old('tipo_propiedad') == 'terreno' ? 'selected' : '' }}>Terreno</option>
                </select>
                <x-input-error :messages="$errors->get('tipo_propiedad')" class="invalid-feedback d-block" />
            </div>

            <!-- Precio -->
            <div class="col-md-4">
                <x-input-label for="precio" class="form-label" :value="__('Precio: ')" />
                <x-text-input id="precio" class="form-control" type="text" name="precio" :value="old('precio')"
                    required autocomplete="precio" />
                <x-input-error :messages="$errors->get('precio')" class="invalid-feedback d-block" />
            </div>

            <!-- Tamaño -->
            <div class="col-md-4">
                <x-input-label for="tamano" class="form-label" :value="__('Tamaño: ')" />
                <x-text-input id="tamano" class="form-control" type="text" name="tamano" :value="old('tamano')"
                    required autocomplete="tamano" />
                <x-input-error :messages="$errors->get('tamano')" class="invalid-feedback d-block" />
            </div>

            <!-- Estado -->
            <div class="col-md-4">
                <x-input-label for="estado" class="form-label" :value="__('Estado: ')" />
                <select id="estado" name="estado" class="form-select">
                    <option value="disponible" {{ old('estado') == 'disponible' ? 'selected' : '' }}>Disponible</option>
                    <option value="vendido" {{ old('estado') == 'vendido' ? 'selected' : '' }}>Vendido</option>
                    <option value="alquilado" {{ old('estado') == 'alquilado' ? 'selected' : '' }}>Alquilado</option>
                </select>
                <x-input-error :messages="$errors->get('estado')" class="invalid-feedback d-block" />
            </div>

            <!-- Dirección -->
            <div class="col-12">
                <x-input-label for="direccion" class="form-label" :value="__('Dirección: ')" />
                <x-text-input id="direccion" class="form-control" type="text" name="direccion" :value="old('direccion')"
                    required autocomplete="direccion" />
                <x-input-error :messages="$errors->get('direccion')" class="invalid-feedback d-block" />
            </div>

            <!-- Descripción -->
            <div class="col-12">
                <x-input-label for="descripcion" class="form-label" :value="__('Descripción: ')" />
                <textarea name="descripcion" id="descripcion" rows="4" class="form-control">{{ old('descripcion') }}</textarea>
                <x-input-error :messages="$errors->get('descripcion')" class="invalid-feedback d-block" />
            </div>

            <!-- Imágenes -->
            <div class="col-12">
                <label for="imagenes" class="form-label">Selecciona las imágenes:</label>
                <input type="file" class="form-control" id="imagenes" name="imagenes[]"
                    accept=".jpg,.jpeg,.png,.svg" multiple>
            </div>

            <!-- Botones -->
            <div class="col-12">
                <x-primary-button class="btn btn-primary">
                    {{ __('Añadir Inmueble') }}
                </x-primary-button>

                <a href="{{ route('agente.dashboard') }}" class="btn btn-secondary">Volver</a>
            </div>
        </form>
    </main>
</x-agente-layout>

<x-agente-layout>
    <main class="container-lg">
        <h1 class="mt-4 mb-4">Editar Inmueble</h1>
        <form action="{{ route('inmueble.actualizar', $inmueble->id) }}" method="POST" enctype="multipart/form-data"
            class="row g-3">
            @csrf
            @method('PUT')

            <!-- Nombre -->
            <div class="col-md-6">
                <x-input-label for="nombre" class="form-label" :value="__('Nombre:')" />
                <x-text-input id="nombre" class="form-control" type="text" name="nombre"
                    value="{{ $inmueble->nombre }}" required />
                <x-input-error :messages="$errors->get('nombre')" class="invalid-feedback d-block" />
            </div>

            <!-- Dirección -->
            <div class="col-md-6">
                <x-input-label for="direccion" class="form-label" :value="__('Dirección:')" />
                <x-text-input id="direccion" class="form-control" type="text" name="direccion"
                    value="{{ $inmueble->direccion }}" required />
                <x-input-error :messages="$errors->get('direccion')" class="invalid-feedback d-block" />
            </div>

            <!-- Tipo de Propiedad -->
            <div class="col-md-4">
                <x-input-label for="tipo_propiedad" class="form-label" :value="__('Tipo de Propiedad: ')" />
                <select id="tipo_propiedad" name="tipo_propiedad" class="form-select">
                    <option value="casa" @if ($inmueble->tipo_propiedad == 'casa') selected @endif>Casa</option>
                    <option value="apartamento" @if ($inmueble->tipo_propiedad == 'apartamento') selected @endif>Apartamento</option>
                    <option value="terreno" @if ($inmueble->tipo_propiedad == 'terreno') selected @endif>Terreno</option>
                </select>
                <x-input-error :messages="$errors->get('tipo_propiedad')" class="invalid-feedback d-block" />
            </div>

            <!-- Precio -->
            <div class="col-md-4">
                <x-input-label for="precio" class="form-label" :value="__('Precio:')" />
                <x-text-input id="precio" class="form-control" type="text" name="precio"
                    value="{{ $inmueble->precio }}" required />
                <x-input-error :messages="$errors->get('precio')" class="invalid-feedback d-block" />
            </div>

            <!-- Tamaño -->
            <div class="col-md-4">
                <x-input-label for="tamano" class="form-label" :value="__('Tamaño:')" />
                <x-text-input id="tamano" class="form-control" type="text" name="tamano"
                    value="{{ $inmueble->tamano }}" required />
                <x-input-error :messages="$errors->get('tamano')" class="invalid-feedback d-block" />
            </div>

            <!-- Descripción -->
            <div class="col-12">
                <x-input-label for="descripcion" class="form-label" :value="__('Descripción: ')" />
                <textarea name="descripcion" id="descripcion" rows="4" class="form-control">{{ $inmueble->descripcion }}</textarea>
                <x-input-error :messages="$errors->get('descripcion')" class="invalid-feedback d-block" />
            </div>

            <!-- Estado -->
            <div class="col-md-6">
                <x-input-label for="estado" class="form-label" :value="__('Estado: ')" />
                <select id="estado" name="estado" class="form-select">
                    <option value="disponible" @if ($inmueble->estado == 'disponible') selected @endif>Disponible</option>
                    <option value="vendido" @if ($inmueble->estado == 'vendido') selected @endif>Vendido</option>
                    <option value="alquilado" @if ($inmueble->estado == 'alquilado') selected @endif>Alquilado</option>
                </select>
                <x-input-error :messages="$errors->get('estado')" class="invalid-feedback d-block" />
            </div>

            <!-- Imágenes -->
            <div class="col-md-6">
                <label for="imagenes" class="form-label">Selecciona las imágenes:</label>
                <input type="file" class="form-control" id="imagenes" name="imagenes[]"
                    accept=".jpg,.jpeg,.png,.svg" multiple>
            </div>

            <!-- Botón de Guardar -->
            <div class="col-12">
                <x-primary-button class="btn btn-primary">
                    {{ __('Guardar Cambios') }}
                </x-primary-button>
                <a href="{{ route('agente.dashboard') }}" class="btn btn-secondary mx-2">Volver</a>
            </div>
        </form>
    </main>
</x-agente-layout>

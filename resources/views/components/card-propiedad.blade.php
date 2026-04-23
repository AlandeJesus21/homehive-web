<div class="prop-card" title="Tarjeta de propiedad disponible">

    @php
        $imagen = $propiedad->imagenes->first();
    @endphp

    <div class="prop-img" title="Imagen de la propiedad">
        @if($imagen)
        <img src="{{ $imagen ? asset('storage/' . $imagen->ruta) : 'https://via.placeholder.com/300x200' }}"
             alt="Imagen de la propiedad"
             title="Vista previa de la propiedad">
        @else
        <div class="bg-light rounded-4 d-flex align-items-center justify-content-center"
             style="height: 180px;"
             title="No hay imagen disponible">
            <small title="Sin imagen">Sin foto</small>
        </div>
        @endif
    </div>

    <div class="prop-body" title="Información de la propiedad">

        <div class="d-flex justify-content-between align-items-center mb-2">
            <span class="prop-price" title="Precio de renta">${{ $propiedad->precio }}</span>

            @auth
            <form action="{{ route('misfavoritos', $propiedad->id) }}" 
                  method="POST"
                  class="m-0"
                  title="Agregar o quitar de favoritos">
                @csrf
                <button type="submit" 
                        class="btn p-0 border-0 shadow-none"
                        title="Guardar en favoritos">
                    @if (auth()->user()->favoritos->contains($propiedad->id))
                    <i class="bi bi-bookmark-fill text-dark" 
                       style="font-size: 1.2rem;"
                       title="Quitar de favoritos"></i>
                    @else
                    <i class="bi bi-bookmark text-secondary" 
                       style="font-size: 1.2rem;"
                       title="Agregar a favoritos"></i>
                    @endif
                </button>
            </form>
            @endauth
        </div>

        <div class="prop-title" title="Nombre de la propiedad">
            {{ $propiedad->titulo }}
        </div>

        <div class="prop-location" title="Ubicación de la propiedad">
            {{ $propiedad->barrio->nombre }}, {{ $propiedad->calle }}
        </div>

        <a href="{{ route('main.vermas', $propiedad->id) }}"
           class="btn btn-primary w-100 mt-3 prop-btn"
           title="Ver detalles completos de la propiedad">
            Ver más
        </a>

    </div>

</div>
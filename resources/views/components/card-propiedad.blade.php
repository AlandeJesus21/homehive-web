<div class="card-container h-100">

    <div class="card shadow-sm border-0 rounded-4 h-100 d-flex flex-column">

        @php
        $imagen = $propiedad->imagenes->first();
        @endphp

        <img src="{{ $imagen ? asset('storage/' . $imagen->ruta) : 'https://via.placeholder.com/300x200' }}"
            class="card-img-top rounded-top-4" style="height: 200px; object-fit: cover;">

        <div class="card-body d-flex flex-column">

            <h6 class="fw-bold mb-1">${{ $propiedad->precio }}</h6>

            <p class="mb-1 text-truncate">
                {{ $propiedad->titulo }}
            </p>

            <small class="text-muted">
                {{ $propiedad->barrio->nombre }}, {{ $propiedad->calle }}
            </small>

            <div class="mt-auto pt-3 text-center">
                <a href="{{ route('propiedades.show', $propiedad->id) }}"
                    class="btn btn-primary btn-sm px-4 rounded-pill w-100">
                    Ver más
                </a>
            </div>

        </div>
    </div>

</div>
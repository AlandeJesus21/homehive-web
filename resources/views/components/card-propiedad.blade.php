<div class="card-container">

    <div class="card shadow-sm border-0 rounded-4 h-100">
        @php
        $imagen = $propiedad->imagenes->first();
        @endphp

        <img src="{{ $imagen ? asset('storage/' . $imagen->ruta) : 'https://via.placeholder.com/300x200' }}"
            class="card-img-top" width="200" height="200">

        <div class="card-body">
            <h6 class="fw-bold">${{ $propiedad->precio }}</h6>
            <p class="mb-1">{{ $propiedad->titulo }}</p>
            <small class="text-muted">
                {{ $propiedad->barrio->nombre }}, {{ $propiedad->calle }}
            </small>

            <div class="mt-3 text-center">
                <button class="btn btn-primary btn-sm px-4 rounded-pill">
                    Ver más
                </button>
            </div>
        </div>
    </div>

</div>
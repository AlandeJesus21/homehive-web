<div class="prop-card">

    @php
        $imagen = $propiedad->imagenes->first();
    @endphp

    <!-- IMAGEN -->
    <div class="prop-img">
        <img src="{{ $imagen ? asset('storage/' . $imagen->ruta) : 'https://via.placeholder.com/300x200' }}">
    </div>

    <!-- CONTENIDO -->
    <div class="prop-body">

        <!-- PRECIO + ICONO -->
        <div class="d-flex justify-content-between align-items-center mb-2">
            <span class="prop-price">${{ $propiedad->precio }}</span>
            <i class="bi bi-bookmark prop-icon"></i>
        </div>

        <!-- TITULO -->
        <div class="prop-title">
            {{ $propiedad->titulo }}
        </div>

        <!-- UBICACION -->
        <div class="prop-location">
            {{ $propiedad->barrio->nombre }}, {{ $propiedad->calle }}
        </div>

        <!-- BOTON -->
        <a href="{{ route('main.vermas', $propiedad->id) }}"
           class="btn btn-primary w-100 mt-3 prop-btn">
            Ver más
        </a>

    </div>

</div>
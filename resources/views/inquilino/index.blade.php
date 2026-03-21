<x-inquilino.layout>

    <div class="bg-light py-5 text-center">

        <h2 class="fw-bold mb-4">
            Donde cada estancia se siente como hogar
        </h2>

        <!-- BUSCADOR -->
        <div class="d-flex justify-content-center">
            <div class="bg-white rounded-pill shadow d-flex align-items-center px-3 py-2 w-75">

                <div class="px-3 small text-muted">
                    <i class="bi bi-geo-alt"></i> Zona
                </div>

                <div class="vr"></div>

                <div class="px-3 small text-muted">
                    <i class="bi bi-house"></i> Tipo de propiedad
                </div>

                <div class="vr"></div>

                <div class="px-3 small text-muted">
                    <i class="bi bi-currency-dollar"></i> Precio
                </div>

                <div class="vr"></div>

                <div class="px-3 small text-muted">
                    <i class="bi bi-stars"></i> Servicios
                </div>

                <button class="btn btn-dark rounded-circle ms-auto">
                    <i class="bi bi-search"></i>
                </button>

            </div>
        </div>


    </div>

    <!-- LISTADO -->

    <div class="container mt-4">
        <h5 class="mb-3">Cuartos</h5>

        <div class="d-flex overflow-auto gap-3 pb-3">

            @foreach($propiedades as $propiedad)
            <div class="card shadow-sm" style="min-width: 220px;">

                <img src="{{ asset('imagenes/casa1.jpeg') }}" class="card-img-top">

                <div class="card-body">

                    <div class="d-flex justify-content-between">
                        <span class="fw-bold">${{ $propiedad->precio }}</span>
                        <i class="bi bi-bookmark"></i>
                    </div>

                    <h6 class="mt-2">titulo</h6>
                    <small class="text-muted">Ubicación</small>

                    <a href="{{ route('vermas', $propiedad->id) }}" class="btn btn-primary btn-sm w-100 mt-2">
                        Ver más
                    </a>

                </div>

            </div>
            @endforeach

        </div>


    </div>


</x-inquilino.layout>
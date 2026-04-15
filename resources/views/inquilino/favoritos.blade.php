<x-inquilino.layout>
    <main class="container-fluid">
        <div class="container-fluid py-5 ">
            <h2 class="fw-bold m-0 border-bottom border-secondary border-2 pb-1">Mis favoritos</h2>
            @php
                // Se agrupa las propiedades por tipo (ej: 'Casa', 'Departamento')
                $agrupados = $propiedades->groupBy('tipo');
            @endphp
            @foreach ($agrupados as $tipo => $items)
                <div class="position-relative mb-5">
                    <h4 class="ps-4 fw-bold text-muted mb-4 text-capitalize">{{ $tipo }}s</h4>

                    <div class="d-flex align-items-center">
                        <button class="btn btn-light rounded-circle shadow-sm position-absolute start-0 ms-2 z-3"
                            onclick="scrollCarrusel('carrusel-{{ $tipo }}', -300)"
                            style="width: 40px; height: 40px;">
                            <i class="bi bi-chevron-left"></i>
                        </button>

                        <div id="carrusel-{{ $tipo }}" class="carrusel-horizontal px-4">
                            @foreach ($items as $propiedad)
                                <div class="card-propiedad shadow-lg border-0 bg-white mb-3">
                                    <div class="p-2">
                                        @if ($propiedad->imagenes->count() > 0)
                                            <img src="{{ asset('storage/' . $propiedad->imagenes->first()->ruta) }}"
                                                class="img-fluid rounded-4"
                                                style="height: 180px; width: 100%; object-fit: cover;">
                                        @else
                                            <div class="bg-light rounded-4 d-flex align-items-center justify-content-center"
                                                style="height: 180px;">
                                                <small>Sin foto</small>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="card-body px-4 pb-4 pt-0">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span
                                                class="fw-bold fs-4 text-dark">${{ number_format($propiedad->precio) }}</span>

                                            @auth
                                                <form action="{{ route('misfavoritos', $propiedad->id) }}" method="POST"
                                                    class="m-0">
                                                    @csrf
                                                    <button type="submit" class="btn p-0 border-0 shadow-none">
                                                    @if (auth()->user()->favoritos->contains('id', $propiedad->id))
                                                            <i class="bi bi-bookmark-fill text-dark"
                                                                style="font-size: 1.2rem;"></i>
                                                        @else
                                                            <i class="bi bi-bookmark text-secondary"
                                                                style="font-size: 1.2rem;"></i>
                                                        @endif
                                                    </button>
                                                </form>
                                            @endauth
                                        </div>

                                        <h5 class="fw-bold mb-1 text-dark" style="font-size: 1.1rem;">
                                            {{ $propiedad->titulo }}
                                        </h5>

                                        <p class="text-muted mb-4" style="font-size: 0.95rem; font-weight: 400;">
                                            {{ $propiedad->calle ?? 'Ubicación no disponible' }}
                                        </p>

                                        <div class="text-center">
                                            <a href="{{ route('vermas', $propiedad->id) }}"
                                                class="btn btn-primary w-75 py-2 shadow-sm text-white"
                                                style="border: none; border-radius: 12px; font-weight: 500; background-color: #2b448c;">
                                                Ver mas
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <button class="btn btn-light rounded-circle shadow-sm position-absolute end-0 me-2 z-3"
                            onclick="scrollCarrusel('carrusel-{{ $tipo }}', 300)"
                            style="width: 40px; height: 40px;">
                            <i class="bi bi-chevron-right"></i>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

        <script>
            function scrollCarrusel(id, distance) {
                document.getElementById(id).scrollBy({
                    left: distance,
                    behavior: 'smooth'
                });
            }
        </script>
    </main>
</x-inquilino.layout>

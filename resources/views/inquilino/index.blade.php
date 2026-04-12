<x-inquilino.layout>

    <main class="container-fluid">

        <h2 class="fw-bold mb-4 text-center " style="margin-top:30px">
            Donde cada estancia se siente como hogar
        </h2>


        <div class="container mt-5">
            <form action="{{ route('buscar') }}" method="GET">
                <div class="d-flex justify-content-center">
                    <div class="search bg-white shadow d-flex flex-column flex-md-row align-items-stretch align-items-md-center px-3 py-2 w-100 rounded-pill"
                        style="max-width: 900px;">

                        <div class="flex-grow-1 px-3 dropdown">
                            <div class="c-pointer py-2" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-geo-alt-fill me-3"></i>
                                {{-- <svg xmlns="http://www.w3.org/2000/svg"
                                    width="16" height="16" fill="currentColor" class="bi bi-geo-alt"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10" />
                                    <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                                </svg> --}}
                                Zona
                            </div>
                            <ul class="dropdown-menu shadow border-0 rounded-4 p-3" style="min-width: 200px;">
                                <li>
                                    <h6 class="dropdown-header">Selecciona un barrio</h6>
                                </li>
                                @foreach ($barrio as $barrios)
                                    <li>
                                        <div class="form-check m-2">
                                            <input class="form-check-input" type="checkbox" name="barrios[]"
                                                value="{{ $barrios->nombre }}" id="b-{{ $barrios->id }}">
                                            <label class="form-check-label"
                                                for="b-{{ $barrios->id }}">{{ $barrios->nombre }}</label>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="vr d-none d-md-block"></div>

                        <div class="flex-grow-1 px-3 dropdown">
                            <div class="c-pointer py-2" data-bs-toggle="dropdown">
                                <i class="bi bi-house-fill me-3"></i> {{-- <svg xmlns="http://www.w3.org/2000/svg"
                                    width="16" height="16" fill="currentColor" class="bi bi-house"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z" />
                                </svg>--}}Tipo
                            </div>
                            <ul class="dropdown-menu shadow border-0 rounded-4 p-2">
                                <li><button class="dropdown-item" type="button" onclick="setTipo('Casa')">Casa</button>
                                </li>
                                <li><button class="dropdown-item" type="button"
                                        onclick="setTipo('Departamento')">Departamento</button></li>
                                <li><button class="dropdown-item" type="button"
                                        onclick="setTipo('Cuarto')">Cuarto</button></li>
                                <input type="hidden" name="tipo" id="tipo_hidden">
                            </ul>
                        </div>

                        <div class="vr d-none d-md-block"></div>

                        <div class="flex-grow-1 px-3 dropdown">
                            <div class="c-pointer py-2" data-bs-toggle="dropdown">
                                <i class="bi bi-coin"></i>
                                {{-- <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-coin me-3" viewBox="0 0 16 16">
                                    <path
                                        d="M5.5 9.511c.076.954.83 1.697 2.182 1.785V12h.6v-.709c1.4-.098 2.218-.846 2.218-1.932 0-.987-.626-1.496-1.745-1.76l-.473-.112V5.57c.6.068.982.396 1.074.85h1.052c-.076-.919-.864-1.638-2.126-1.716V4h-.6v.719c-1.195.117-2.01.836-2.01 1.853 0 .9.606 1.472 1.613 1.707l.397.098v2.034c-.615-.093-1.022-.43-1.114-.9zm2.177-2.166c-.59-.137-.91-.416-.91-.836 0-.47.345-.822.915-.925v1.76h-.005zm.692 1.193c.717.166 1.048.435 1.048.91 0 .542-.412.914-1.135.982V8.518z" />
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                    <path
                                        d="M8 13.5a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11m0 .5A6 6 0 1 0 8 2a6 6 0 0 0 0 12" />
                                </svg> --}}
                                Precio
                            </div>
                            <div class="dropdown-menu shadow border-0 rounded-4 p-4" style="min-width: 250px;">
                                <label class="small fw-bold">Precio min:</label>
                                <input type="number" name="min" class="form-control rounded-3 mb-2"
                                    placeholder="$">
                                <label class="small fw-bold">Precio max:</label>
                                <input type="number" name="max" class="form-control rounded-3" placeholder="$">
                            </div>
                        </div>

                        <div class="vr d-none d-md-block"></div>

                        <div class="flex-grow-1 px-3 dropdown">
                            <div class="c-pointer py-2" data-bs-toggle="dropdown">
                                <i class="bi bi-wifi me-3"></i>
                                {{-- <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                    height="16" fill="currentColor" class="bi bi-wifi" viewBox="0 0 16 16">
                                    <path
                                        d="M15.384 6.115a.485.485 0 0 0-.047-.736A12.44 12.44 0 0 0 8 3C5.259 3 2.723 3.882.663 5.379a.485.485 0 0 0-.048.736.52.52 0 0 0 .668.05A11.45 11.45 0 0 1 8 4c2.507 0 4.827.802 6.716 2.164.205.148.49.13.668-.049" />
                                    <path
                                        d="M13.229 8.271a.482.482 0 0 0-.063-.745A9.46 9.46 0 0 0 8 6c-1.905 0-3.68.56-5.166 1.526a.48.48 0 0 0-.063.745.525.525 0 0 0 .652.065A8.46 8.46 0 0 1 8 7a8.46 8.46 0 0 1 4.576 1.336c.206.132.48.108.653-.065m-2.183 2.183c.226-.226.185-.605-.1-.75A6.5 6.5 0 0 0 8 9c-1.06 0-2.062.254-2.946.704-.285.145-.326.524-.1.75l.015.015c.16.16.407.19.611.09A5.5 5.5 0 0 1 8 10c.868 0 1.69.201 2.42.56.203.1.45.07.61-.091zM9.06 12.44c.196-.196.198-.52-.04-.66A2 2 0 0 0 8 11.5a2 2 0 0 0-1.02.28c-.238.14-.236.464-.04.66l.706.706a.5.5 0 0 0 .707 0l.707-.707z" />
                                </svg> --}}
                                Servicios
                            </div>
                            <div class="dropdown-menu shadow border-0 rounded-4 p-3" style="min-width: 220px;">
                                @foreach (['Agua', 'Internet', 'Gas', 'Estacionamiento'] as $servicio)
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" name="servicio[]"
                                            value="{{ $servicio }}" id="{{ $servicio }}">
                                        <label class="form-check-label"
                                            for="{{ $servicio }}">{{ $servicio }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="ps-md-3">
                            <button type="submit" class="btn d-flex align-items-center justify-content-center"
                                style="width: 45px; height: 45px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black"
                                    class="bi bi-search" viewBox="0 0 16 16">
                                    <path
                                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>



        <div class="container-fluid py-4 ">
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
                                            <span class="fw-bold fs-4 text-dark">
                                                ${{ number_format($propiedad->precio) }}
                                            </span>

                                            @auth
                                                <form action="{{ route('misfavoritos', $propiedad->id) }}" method="POST"
                                                    class="m-0">
                                                    @csrf
                                                    <button type="submit" class="btn p-0 border-0 shadow-none">
                                                        @if (auth()->user()->favoritos->contains($propiedad->id))
                                                            <i class="bi bi-bookmark-fill text-dark"
                                                                style="font-size: 1.2rem;"></i>
                                                        @else
                                                            <i class="bi bi-bookmark text-secondary"
                                                                style="font-size: 1.2rem;"></i>
                                                        @endif
                                                    </button>
                                                </form>
                                            @else
                                                {{-- Enlace al login para usuarios no autenticados --}}
                                                <a href="{{ route('login') }}" class="text-secondary">
                                                    <i class="bi bi-bookmark" style="font-size: 1.2rem;"></i>
                                                </a>
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
        {{-- <script>
            function scrollCarrusel(id, distance) {
                const contenedor = document.getElementById(id);
                contenedor.scrollBy({
                    left: distance,
                    behavior: 'smooth'
                });
            }
        </script> --}}

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

<x-layout>

    <!-- HERO / BÚSQUEDA -->
    <section class="py-5 text-center">
        <div class="container">
            <h2 class="mb-4">Donde cada estancia se siente como un hogar</h2>

            <form method="GET" action="{{ route('busqueda') }}">
                <div class="d-flex justify-content-center">
                    <div class="search-bar shadow rounded-pill d-none d-md-flex">

                        <div class="filter-item">
                            <i class="bi bi-geo-alt"></i>
                            <select name="barrio_id">
                                <option value="">Zona</option>
                                @foreach ($barrios as $barrio)
                                <option value="{{ $barrio->id }}"
                                    {{ request('barrio_id') == $barrio->id ? 'selected' : '' }}>
                                    {{ $barrio->nombre }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="divider"></div>

                        <div class="filter-item">
                            <i class="bi bi-house"></i>
                            <select name="tipo">
                                <option value="">Tipo de propiedad</option>
                                <option value="casa" {{ request('tipo') == 'casa' ? 'selected' : '' }}>Casa</option>
                                <option value="departamento" {{ request('tipo') == 'departamento' ? 'selected' : '' }}>
                                    Departamento</option>
                                <option value="cuarto" {{ request('tipo') == 'cuarto' ? 'selected' : '' }}>Cuarto
                                </option>
                            </select>
                        </div>

                        <div class="divider"></div>

                        <div class="filter-item">
                            <i class="bi bi-currency-dollar"></i>
                            <input type="number" value="{{ request('precio') }}" name="precio" placeholder="Precio">
                        </div>

                        <div class="divider"></div>

                        <div class="filter-item">
                            <i class="bi bi-person"></i>
                            <input type="text" value="{{ request('servicio') }}" name="servicio"
                                placeholder="Servicios">
                        </div>

                        <button type="submit" class="search-btn">
                            <img src="{{ asset('images/busqueda.png') }}" alt="Buscar" width="20" height="20">
                        </button>

                    </div>
                </div>
            </form>

            <div class="d-md-none d-flex justify-content-end px-3">
                <button class="btn btn-primary rounded-circle d-flex align-items-center justify-content-center shadow"
                    style="width: 45px; height: 45px;" data-bs-toggle="modal" data-bs-target="#filtroModal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor"
                        stroke-width="2" viewBox="0 0 24 24">
                        <line x1="4" y1="6" x2="20" y2="6" />
                        <circle cx="10" cy="6" r="2" />
                        <line x1="4" y1="12" x2="20" y2="12" />
                        <circle cx="14" cy="12" r="2" />
                        <line x1="4" y1="18" x2="20" y2="18" />
                        <circle cx="8" cy="18" r="2" />
                    </svg>
                </button>
            </div>

        </div>
    </section>

    <div class="container py-5">

        @php
        $isBusqueda = request()->hasAny(['barrio_id','tipo','precio','servicio']);
        @endphp

        {{-- CUARTOS --}}
        @if ($cuartos->isNotEmpty())
        <h3 class="mb-4">Cuartos</h3>

        @if(!$isBusqueda)
        {{-- Carrusel inicio --}}
        <div class="position-relative">
            <button id="left-cuartos"
                class="btn btn-light shadow rounded-circle position-absolute top-50 start-0 translate-middle-y z-2">‹</button>
            <div class="carousel-container">
                <div id="cuartos" class="d-flex overflow-auto gap-4 w-100">
                    @foreach ($cuartos as $cuarto)
                    <x-card-propiedad :propiedad="$cuarto" />
                    @endforeach
                </div>
            </div>
            <button id="right-cuartos"
                class="btn btn-light shadow rounded-circle position-absolute top-50 end-0 translate-middle-y z-2">›</button>
        </div>
        @else
        {{-- Grid búsqueda --}}
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            @foreach ($cuartos as $cuarto)
            <div class="col">
                <x-card-propiedad :propiedad="$cuarto" />
            </div>
            @endforeach
        </div>
        @endif
        @endif

        {{-- CASAS --}}
        @if ($casas->isNotEmpty())
        <h3 class="mt-5 mb-4">Casas</h3>

        @if(!$isBusqueda)
        <div class="position-relative">
            <button id="left-casas"
                class="btn btn-light shadow rounded-circle position-absolute top-50 start-0 translate-middle-y z-2">‹</button>
            <div class="carousel-container">
                <div id="casas" class="d-flex overflow-auto gap-4 w-100">
                    @foreach ($casas as $casa)
                    <x-card-propiedad :propiedad="$casa" />
                    @endforeach
                </div>
            </div>
            <button id="right-casas"
                class="btn btn-light shadow rounded-circle position-absolute top-50 end-0 translate-middle-y z-2">›</button>
        </div>
        @else
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            @foreach ($casas as $casa)
            <div class="col">
                <x-card-propiedad :propiedad="$casa" />
            </div>
            @endforeach
        </div>
        @endif
        @endif

        {{-- DEPARTAMENTOS --}}
        @if ($departamentos->isNotEmpty())
        <h3 class="mt-5 mb-4">Departamentos</h3>

        @if(!$isBusqueda)
        <div class="position-relative">
            <button id="left-departamentos"
                class="btn btn-light shadow rounded-circle position-absolute top-50 start-0 translate-middle-y z-2">‹</button>
            <div class="carousel-container">
                <div id="departamentos" class="d-flex overflow-auto gap-4 w-100">
                    @foreach ($departamentos as $departamento)
                    <x-card-propiedad :propiedad="$departamento" />
                    @endforeach
                </div>
            </div>
            <button id="right-departamentos"
                class="btn btn-light shadow rounded-circle position-absolute top-50 end-0 translate-middle-y z-2">›</button>
        </div>
        @else
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            @foreach ($departamentos as $departamento)
            <div class="col">
                <x-card-propiedad :propiedad="$departamento" />
            </div>
            @endforeach
        </div>
        @endif
        @endif

    </div>

    <!-- MODAL FILTRO MÓVIL -->
    <div class="modal fade" id="filtroModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4">
                <div class="modal-header">
                    <h5 class="modal-title">Filtros</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="GET" action="{{ route('busqueda') }}">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Zona</label>
                            <select name="barrio_id" class="form-select">
                                <option value="">Seleccionar</option>
                                @foreach ($barrios as $barrio)
                                <option value="{{ $barrio->id }}"
                                    {{ request('barrio_id') == $barrio->id ? 'selected' : '' }}>
                                    {{ $barrio->nombre }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Tipo</label>
                            <select name="tipo" class="form-select">
                                <option value="">Tipo de propiedad</option>
                                <option value="casa" {{ request('tipo') == 'casa' ? 'selected' : '' }}>Casa</option>
                                <option value="departamento" {{ request('tipo') == 'departamento' ? 'selected' : '' }}>
                                    Departamento</option>
                                <option value="cuarto" {{ request('tipo') == 'cuarto' ? 'selected' : '' }}>Cuarto
                                </option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Precio máximo</label>
                            <input type="number" value="{{ $precio ?? '' }}" name="precio" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Servicios</label>
                            <input type="text" value="{{ $servicio ?? '' }}" name="servicio" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary w-100">Aplicar filtros</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- SCRIPT CARRUSELES -->
    <script>
    function initCarousel(id) {
        const container = document.getElementById(id);
        if (!container) return; // evita error si no existe
        const leftBtn = document.getElementById('left-' + id);
        const rightBtn = document.getElementById('right-' + id);

        if (!leftBtn || !rightBtn) return;

        function updateButtons() {
            const scrollLeft = container.scrollLeft;
            const maxScroll = container.scrollWidth - container.clientWidth;

            leftBtn.style.display = scrollLeft <= 0 ? 'none' : 'block';
            rightBtn.style.display = scrollLeft >= maxScroll - 5 ? 'none' : 'block';
        }

        rightBtn.addEventListener('click', () => {
            container.scrollBy({
                left: 300,
                behavior: 'smooth'
            });
        });

        leftBtn.addEventListener('click', () => {
            container.scrollBy({
                left: -300,
                behavior: 'smooth'
            });
        });

        container.addEventListener('scroll', updateButtons);
        updateButtons();
    }

    initCarousel('cuartos');
    initCarousel('casas');
    initCarousel('departamentos');
    </script>

</x-layout>
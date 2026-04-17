<x-layout>
    <section class="py-5 text-center">
        <div class="container">
            <h2 class="mb-4">Donde cada estancia se siente como un hogar</h2>

            <form method="GET" action="{{ route('busqueda') }}" class="d-none d-md-flex justify-content-center">
                <div class="d-flex justify-content-center">
                    <div class="search-bar shadow rounded-pill d-flex align-items-center px-3 py-2">

                        <div class="filter-item dropdown">
                            <div data-bs-toggle="dropdown" 
                                 class="filter-btn" 
                                 id="zona_btn" 
                                 title="Seleccionar ubicación o barrio">
                                <i class="bi bi-geo-alt"></i> Zona
                            </div>

                            <div class="dropdown-menu p-3 rounded-4 shadow">
                                @foreach ($barrios as $barrio)
                                    <div class="form-check">
                                        <input class="form-check-input" 
                                               type="radio" 
                                               name="barrio_id" 
                                               value="{{ $barrio->id }}" 
                                               id="barrio-{{ $barrio->id }}" 
                                               title="Filtrar por {{ $barrio->nombre }}"
                                               {{ request('barrio_id') == $barrio->id ? 'checked' : '' }} 
                                               onchange="this.form.submit()">
                                        <label class="form-check-label" for="barrio-{{ $barrio->id }}">
                                            {{ $barrio->nombre }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="divider"></div>

                        <div class="filter-item dropdown">
                            <div data-bs-toggle="dropdown" 
                                 class="filter-btn" 
                                 id="tipo_btn" 
                                 title="Seleccionar tipo de inmueble">
                                <i class="bi bi-house"></i> Tipo de propiedad
                            </div>

                            <div class="dropdown-menu p-3 rounded-4 shadow">
                                @foreach (['casa','departamento','cuarto'] as $tipo)
                                    <div class="dropdown-item" 
                                         onclick="setTipo('{{ $tipo }}')" 
                                         title="Mostrar solo {{ $tipo }}s">
                                        {{ ucfirst($tipo) }}
                                    </div>
                                @endforeach
                            </div>
                            <input type="hidden" name="tipo" id="tipo_input" value="{{ request('tipo') }}">
                        </div>

                        <div class="divider"></div>

                        <div class="filter-item dropdown">
                            <div data-bs-toggle="dropdown" 
                                 class="filter-btn" 
                                 id="precio_btn" 
                                 title="Filtrar por rango de precio">
                                <i class="bi bi-currency-dollar"></i> Precio
                            </div>

                            <div class="dropdown-menu p-3 rounded-4 shadow">
                                <label>Precio min:</label>
                                <input type="number" 
                                       name="min" 
                                       value="{{ request('min') }}" 
                                       class="form-control mb-2" 
                                       title="Ingresar precio mínimo"
                                       oninput="updatePrecio()">

                                <label>Precio max:</label>
                                <input type="number" 
                                       name="max" 
                                       value="{{ request('max') }}" 
                                       class="form-control" 
                                       title="Ingresar precio máximo"
                                       oninput="updatePrecio()">
                            </div>
                        </div>

                        <div class="divider"></div>

                        <div class="filter-item dropdown">
                            <div data-bs-toggle="dropdown" 
                                 class="filter-btn" 
                                 id="servicios_btn" 
                                 title="Filtrar por servicios y comodidades">
                                <i class="bi bi-wifi"></i> Servicios
                            </div>

                            <div class="dropdown-menu p-3 rounded-4 shadow" style="width:300px; max-height:300px; overflow:auto;">
                                @php $serviciosSeleccionados = request('servicios', []); @endphp

                                <p class="fw-bold mb-2">Servicios básicos</p>
                                @foreach(['wifi' => 'WiFi / Internet', 'agua' => 'Agua', 'luz' => 'Luz', 'gas' => 'Gas', 'basura' => 'Recolección de basura'] as $value => $label)
                                    <div class="form-check">
                                        <input class="form-check-input servicio-check" 
                                               type="checkbox" 
                                               name="servicios[]" 
                                               value="{{ $value }}" 
                                               id="servicio-{{ $value }}" 
                                               title="Incluir {{ $label }}"
                                               {{ in_array($value, $serviciosSeleccionados) ? 'checked' : '' }} 
                                               onchange="updateServicios()">
                                        <label class="form-check-label" for="servicio-{{ $value }}">{{ $label }}</label>
                                    </div>
                                @endforeach

                                <p class="fw-bold mt-3 mb-2">Comodidades</p>
                                @foreach(['baño_privado' => 'Baño propio', 'baño_compartido' => 'Baño compartido', 'aire' => 'Aire acondicionado', 'ventilador' => 'Ventilador de techo', 'entrada_independiente' => 'Entrada independiente', 'cama' => 'Cama incluida'] as $value => $label)
                                    <div class="form-check">
                                        <input class="form-check-input servicio-check" 
                                               type="checkbox" 
                                               name="servicios[]" 
                                               value="{{ $value }}" 
                                               id="servicio-{{ $value }}" 
                                               title="Incluir {{ $label }}"
                                               {{ in_array($value, $serviciosSeleccionados) ? 'checked' : '' }} 
                                               onchange="updateServicios()">
                                        <label class="form-check-label" for="servicio-{{ $value }}">{{ $label }}</label>
                                    </div>
                                @endforeach

                                <p class="fw-bold mt-3 mb-2">Mobiliario</p>
                                @foreach(['escritorio' => 'Escritorio y silla', 'closet' => 'Clóset', 'frigobar' => 'Frigobar', 'parrilla' => 'Parrilla'] as $value => $label)
                                    <div class="form-check">
                                        <input class="form-check-input servicio-check" 
                                               type="checkbox" 
                                               name="servicios[]" 
                                               value="{{ $value }}" 
                                               id="servicio-{{ $value }}" 
                                               title="Incluir {{ $label }}"
                                               {{ in_array($value, $serviciosSeleccionados) ? 'checked' : '' }} 
                                               onchange="updateServicios()">
                                        <label class="form-check-label" for="servicio-{{ $value }}">{{ $label }}</label>
                                    </div>
                                @endforeach

                                <p class="fw-bold mt-3 mb-2">Áreas comunes</p>
                                @foreach(['cocina' => 'Cocina compartida', 'cocina_propia' => 'Cocina propia', 'lavado' => 'Área de lavado', 'estacionamiento' => 'Estacionamiento', 'camaras' => 'Cámaras de seguridad', 'limpieza' => 'Limpieza de áreas comunes'] as $value => $label)
                                    <div class="form-check">
                                        <input class="form-check-input servicio-check" 
                                               type="checkbox" 
                                               name="servicios[]" 
                                               value="{{ $value }}" 
                                               id="servicio-{{ $value }}" 
                                               title="Incluir {{ $label }}"
                                               {{ in_array($value, $serviciosSeleccionados) ? 'checked' : '' }} 
                                               onchange="updateServicios()">
                                        <label class="form-check-label" for="servicio-{{ $value }}">{{ $label }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <button class="search-btn" title="Ejecutar búsqueda">
                            <i class="search_btn"><img src="{{ asset('images/busqueda.png') }}" width="20" height="20" alt="Buscar"></i>

                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <div class="d-md-none d-flex justify-content-end px-3">
        <button class="btn btn-primary rounded-circle d-flex align-items-center justify-content-center shadow" 
                style="width: 45px; height: 45px;" 
                data-bs-toggle="modal" 
                data-bs-target="#filtroModal" 
                title="Abrir filtros avanzados">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <line x1="4" y1="6" x2="20" y2="6" /><circle cx="10" cy="6" r="2" />
                <line x1="4" y1="12" x2="20" y2="12" /><circle cx="14" cy="12" r="2" />
                <line x1="4" y1="18" x2="20" y2="18" /><circle cx="8" cy="18" r="2" />
            </svg>
        </button>
    </div>

    <div class="container py-5">
        @php $isBusqueda = request()->hasAny(['barrio_id','tipo','min','max','servicios']); @endphp

        @if ($cuartos->isNotEmpty())
            <h3 class="mb-4">Cuartos</h3>
            @if(!$isBusqueda)
                <div class="position-relative">
                    <button id="left-cuartos" class="btn btn-light shadow rounded-circle position-absolute top-50 start-0 translate-middle-y z-2" title="Desplazar a la izquierda">‹</button>
                    <div class="carousel-container">
                        <div id="cuartos" class="d-flex overflow-auto gap-4 w-100">
                            @foreach ($cuartos as $cuarto)
                                <x-card-propiedad :propiedad="$cuarto" />
                            @endforeach
                        </div>
                    </div>
                    <button id="right-cuartos" class="btn btn-light shadow rounded-circle position-absolute top-50 end-0 translate-middle-y z-2" title="Desplazar a la derecha">›</button>
                </div>
            @else
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                    @foreach ($cuartos as $cuarto)
                        <div class="col"><x-card-propiedad :propiedad="$cuarto" /></div>
                    @endforeach
                </div>
            @endif
        @endif

        @if ($casas->isNotEmpty())
            <h3 class="mt-5 mb-4">Casas</h3>
            @if(!$isBusqueda)
                <div class="position-relative">
                    <button id="left-casas" class="btn btn-light shadow rounded-circle position-absolute top-50 start-0 translate-middle-y z-2" title="Desplazar a la izquierda">‹</button>
                    <div class="carousel-container">
                        <div id="casas" class="d-flex overflow-auto gap-4 w-100">
                            @foreach ($casas as $casa)
                                <x-card-propiedad :propiedad="$casa" />
                            @endforeach
                        </div>
                    </div>
                    <button id="right-casas" class="btn btn-light shadow rounded-circle position-absolute top-50 end-0 translate-middle-y z-2" title="Desplazar a la derecha">›</button>
                </div>
            @else
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                    @foreach ($casas as $casa)
                        <div class="col"><x-card-propiedad :propiedad="$casa" /></div>
                    @endforeach
                </div>
            @endif
        @endif

        @if ($departamentos->isNotEmpty())
            <h3 class="mt-5 mb-4">Departamentos</h3>
            @if(!$isBusqueda)
                <div class="position-relative">
                    <button id="left-departamentos" class="btn btn-light shadow rounded-circle position-absolute top-50 start-0 translate-middle-y z-2" title="Desplazar a la izquierda">‹</button>
                    <div class="carousel-container">
                        <div id="departamentos" class="d-flex overflow-auto gap-4 w-100">
                            @foreach ($departamentos as $departamento)
                                <x-card-propiedad :propiedad="$departamento" />
                            @endforeach
                        </div>
                    </div>
                    <button id="right-departamentos" class="btn btn-light shadow rounded-circle position-absolute top-50 end-0 translate-middle-y z-2" title="Desplazar a la derecha">›</button>
                </div>
            @else
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                    @foreach ($departamentos as $departamento)
                        <div class="col"><x-card-propiedad :propiedad="$departamento" /></div>
                    @endforeach
                </div>
            @endif
        @endif
    </div>

    <div class="modal fade" id="filtroModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4">
                <div class="modal-header">
                    <h5 class="modal-title">Filtros</h5>
                    <button class="btn-close" data-bs-dismiss="modal" title="Cerrar filtros"></button>
                </div>
                <form method="GET" action="{{ route('busqueda') }}">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Zona</label>
                            <select name="barrio_id" class="form-select" title="Seleccionar zona de búsqueda">
                                <option value="">Seleccionar</option>
                                @foreach ($barrios as $barrio)
                                    <option value="{{ $barrio->id }}" {{ request('barrio_id') == $barrio->id ? 'selected' : '' }}>
                                        {{ $barrio->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Tipo</label>
                            <select name="tipo" class="form-select" title="Seleccionar tipo de inmueble">
                                <option value="">Tipo de propiedad</option>
                                <option value="casa" {{ request('tipo') == 'casa' ? 'selected' : '' }}>Casa</option>
                                <option value="departamento" {{ request('tipo') == 'departamento' ? 'selected' : '' }}>Departamento</option>
                                <option value="cuarto" {{ request('tipo') == 'cuarto' ? 'selected' : '' }}>Cuarto</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Precio máximo</label>
                            <input type="number" name="max" value="{{ request('max') }}" class="form-control" title="Ingresar límite de precio">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary w-100" title="Aplicar criterios de búsqueda">Aplicar filtros</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function initCarousel(id) {
            const container = document.getElementById(id);
            if (!container) return;
            const leftBtn = document.getElementById('left-' + id);
            const rightBtn = document.getElementById('right-' + id);
            if (!leftBtn || !rightBtn) return;

            function updateButtons() {
                const scrollLeft = container.scrollLeft;
                const maxScroll = container.scrollWidth - container.clientWidth;
                leftBtn.style.display = scrollLeft <= 0 ? 'none' : 'block';
                rightBtn.style.display = scrollLeft >= maxScroll - 5 ? 'none' : 'block';
            }

            rightBtn.addEventListener('click', () => container.scrollBy({ left: 300, behavior: 'smooth' }));
            leftBtn.addEventListener('click', () => container.scrollBy({ left: -300, behavior: 'smooth' }));
            container.addEventListener('scroll', updateButtons);
            updateButtons();
        }

        initCarousel('cuartos');
        initCarousel('casas');
        initCarousel('departamentos');

        function setTipo(tipo) {
            document.getElementById('tipo_input').value = tipo;
            document.querySelector('form').submit();
        }

        function updatePrecio() {
            let min = document.querySelector('input[name="min"]').value;
            let max = document.querySelector('input[name="max"]').value;
            document.getElementById('precio_btn').innerHTML = (min || max) 
                ? `<i class="bi bi-currency-dollar"></i> $${min || 0} - $${max || '∞'}`
                : `<i class="bi bi-currency-dollar"></i> Precio`;
        }

        function updateServicios() {
            let checks = document.querySelectorAll('.servicio-check:checked');
            let nombres = Array.from(checks).map(c => c.nextElementSibling.innerText);
            let texto = nombres.length > 0 ? nombres.slice(0, 2).join(', ') + (nombres.length > 2 ? '...' : '') : 'Servicios';
            document.getElementById('servicios_btn').innerHTML = `<i class="bi bi-wifi"></i> ${texto}`;
        }

        document.addEventListener('DOMContentLoaded', () => {
            let zonaText = "{{ optional($barrios->firstWhere('id', request('barrio_id')))->nombre ?? '' }}";
            if (zonaText !== "") document.getElementById('zona_btn').innerHTML = `<i class="bi bi-geo-alt"></i> ${zonaText}`;
            let tipo = "{{ request('tipo') }}";
            if (tipo) document.getElementById('tipo_btn').innerHTML = `<i class="bi bi-house"></i> ${tipo.charAt(0).toUpperCase() + tipo.slice(1)}`;
            updatePrecio();
            updateServicios();
        });
    </script>
</x-layout>
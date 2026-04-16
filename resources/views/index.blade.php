<x-layout>
    <section class="py-5 text-center">
        <div class="container">
            <h2 class="mb-4">Donde cada estancia se siente como un hogar</h2>

            <form method="GET" action="{{ route('busqueda') }}">
                <div class="d-flex justify-content-center">
                    <div class="search-bar shadow rounded-pill d-flex align-items-center px-3 py-2">

                        <!-- ZONA -->
                        <div class="filter-item dropdown">
                            <div data-bs-toggle="dropdown" class="filter-btn" id="zona_btn">
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

                        <!-- TIPO -->
                        <div class="filter-item dropdown">
                            <div data-bs-toggle="dropdown" class="filter-btn" id="tipo_btn">
                                <i class="bi bi-house"></i> Tipo de propiedad
                            </div>

                            <div class="dropdown-menu p-3 rounded-4 shadow">
                                @foreach (['casa','departamento','cuarto'] as $tipo)
                                <div class="dropdown-item" onclick="setTipo('{{ $tipo }}')">
                                    {{ ucfirst($tipo) }}
                                </div>
                                @endforeach
                            </div>

                            <input type="hidden" name="tipo" id="tipo_input" value="{{ request('tipo') }}">
                        </div>

                        <div class="divider"></div>

                        <!-- PRECIO -->
                        <div class="filter-item dropdown">
                            <div data-bs-toggle="dropdown" class="filter-btn" id="precio_btn">
                                <i class="bi bi-currency-dollar"></i> Precio
                            </div>

                            <div class="dropdown-menu p-3 rounded-4 shadow">
                                <label>Precio min:</label>
                                <input type="number"
                                    name="min"
                                    value="{{ request('min') }}"
                                    class="form-control mb-2"
                                    oninput="updatePrecio()">

                                <label>Precio max:</label>
                                <input type="number"
                                    name="max"
                                    value="{{ request('max') }}"
                                    class="form-control"
                                    oninput="updatePrecio()">
                            </div>
                        </div>

                        <div class="divider"></div>

                        <!-- SERVICIOS -->
                        <div class="filter-item dropdown">
                            <div data-bs-toggle="dropdown" class="filter-btn" id="servicios_btn">
                                <i class="bi bi-wifi"></i> Servicios
                            </div>

                            <div class="dropdown-menu p-3 rounded-4 shadow"
                                style="width:300px; max-height:300px; overflow:auto;">

                                @php
                                $serviciosSeleccionados = request('servicios', []);
                                @endphp

                                <!-- BÁSICOS -->
                                <p class="fw-bold mb-2">Servicios básicos</p>

                                @foreach([
                                    'wifi' => 'WiFi / Internet',
                                    'agua' => 'Agua',
                                    'luz' => 'Luz',
                                    'gas' => 'Gas',
                                    'basura' => 'Recolección de basura'
                                ] as $value => $label)

                                <div class="form-check">
                                    <input class="form-check-input servicio-check"
                                        type="checkbox"
                                        name="servicios[]"
                                        value="{{ $value }}"
                                        id="servicio-{{ $value }}"
                                        {{ in_array($value, $serviciosSeleccionados) ? 'checked' : '' }}
                                        onchange="updateServicios()">

                                    <label class="form-check-label" for="servicio-{{ $value }}">
                                        {{ $label }}
                                    </label>
                                </div>

                                @endforeach

                                <!-- COMODIDADES -->
                                <p class="fw-bold mt-3 mb-2">Comodidades</p>

                                @foreach([
                                    'baño_privado' => 'Baño propio',
                                    'baño_compartido' => 'Baño compartido',
                                    'aire' => 'Aire acondicionado',
                                    'ventilador' => 'Ventilador de techo',
                                    'entrada_independiente' => 'Entrada independiente',
                                    'cama' => 'Cama incluida'
                                ] as $value => $label)

                                <div class="form-check">
                                    <input class="form-check-input servicio-check"
                                        type="checkbox"
                                        name="servicios[]"
                                        value="{{ $value }}"
                                        id="servicio-{{ $value }}"
                                        {{ in_array($value, $serviciosSeleccionados) ? 'checked' : '' }}
                                        onchange="updateServicios()">

                                    <label class="form-check-label" for="servicio-{{ $value }}">
                                        {{ $label }}
                                    </label>
                                </div>

                                @endforeach

                                <!-- MOBILIARIO -->
                                <p class="fw-bold mt-3 mb-2">Mobiliario</p>

                                @foreach([
                                    'escritorio' => 'Escritorio y silla',
                                    'closet' => 'Clóset',
                                    'frigobar' => 'Frigobar',
                                    'parrilla' => 'Parrilla'
                                ] as $value => $label)

                                <div class="form-check">
                                    <input class="form-check-input servicio-check"
                                        type="checkbox"
                                        name="servicios[]"
                                        value="{{ $value }}"
                                        id="servicio-{{ $value }}"
                                        {{ in_array($value, $serviciosSeleccionados) ? 'checked' : '' }}
                                        onchange="updateServicios()">

                                    <label class="form-check-label" for="servicio-{{ $value }}">
                                        {{ $label }}
                                    </label>
                                </div>

                                @endforeach

                                <!-- ÁREAS -->
                                <p class="fw-bold mt-3 mb-2">Áreas comunes</p>

                                @foreach([
                                    'cocina' => 'Cocina compartida',
                                    'cocina_propia' => 'Cocina propia',
                                    'lavado' => 'Área de lavado',
                                    'estacionamiento' => 'Estacionamiento',
                                    'camaras' => 'Cámaras de seguridad',
                                    'limpieza' => 'Limpieza de áreas comunes'
                                ] as $value => $label)

                                <div class="form-check">
                                    <input class="form-check-input servicio-check"
                                        type="checkbox"
                                        name="servicios[]"
                                        value="{{ $value }}"
                                        id="servicio-{{ $value }}"
                                        {{ in_array($value, $serviciosSeleccionados) ? 'checked' : '' }}
                                        onchange="updateServicios()">

                                    <label class="form-check-label" for="servicio-{{ $value }}">
                                        {{ $label }}
                                    </label>
                                </div>

                                @endforeach

                            </div>
                        </div>

                        <!-- BOTÓN -->
                        <button class="search-btn">
                            <i class="bi bi-search"></i>
                        </button>

                    </div>
                </div>
            </form>

            </div>
    </section>
    <script>
    function setTipo(tipo) {
        document.getElementById('tipo_input').value = tipo;
        document.querySelector('form').submit();
    }

    function updatePrecio() {
        let min = document.querySelector('input[name="min"]').value;
        let max = document.querySelector('input[name="max"]').value;

        if (min || max) {
            document.getElementById('precio_btn').innerHTML =
                `<i class="bi bi-currency-dollar"></i> $${min || 0} - $${max || '∞'}`;
        } else {
            document.getElementById('precio_btn').innerHTML =
                `<i class="bi bi-currency-dollar"></i> Precio`;
        }
    }

    function updateServicios() {
        let checks = document.querySelectorAll('.servicio-check:checked');

        let nombres = Array.from(checks).map(c => c.nextElementSibling.innerText);

        let texto = nombres.length > 0
            ? nombres.slice(0, 2).join(', ') + (nombres.length > 2 ? '...' : '')
            : 'Servicios';

        document.getElementById('servicios_btn').innerHTML =
            `<i class="bi bi-wifi"></i> ${texto}`;
    }

    document.addEventListener('DOMContentLoaded', () => {

        /* ZONA */
        let zonaText = "{{ optional($barrios->firstWhere('id', request('barrio_id')))->nombre ?? '' }}";

        if (zonaText !== "") {
            document.getElementById('zona_btn').innerHTML =
                `<i class="bi bi-geo-alt"></i> ${zonaText}`;
        }

        /* TIPO */
        let tipo = "{{ request('tipo') }}";

        if (tipo) {
            document.getElementById('tipo_btn').innerHTML =
                `<i class="bi bi-house"></i> ${tipo.charAt(0).toUpperCase() + tipo.slice(1)}`;
        }

        /* PRECIO */
        let min = "{{ request('min') }}";
        let max = "{{ request('max') }}";

        if (min || max) {
            document.getElementById('precio_btn').innerHTML =
                `<i class="bi bi-currency-dollar"></i> $${min || 0} - $${max || '∞'}`;
        }

        /* SERVICIOS */
        updateServicios();

    });
    </script>
</x-layout>


<x-layout>

    <!-- HERO -->
    <section class="py-5 text-center fondo">
        <div class="container">
            <h2 class="mb-4">Donde cada estancia se siente como un hogar</h2>

            <!-- Barra de búsqueda -->
            <form method="GET" action="{{ route('busqueda') }}">
                <div class="d-flex justify-content-center">

                    <div class="search-bar shadow rounded-pill px-3 py-2 d-flex align-items-center gap-3">
                        <img src="{{ asset('images/ubicacion.png') }}" alt="Zona" width="20" height="20">

                        <select name="barrio_id" class="form-select border-0">
                            <option value="">Zona</option>
                            @foreach ($barrios as $barrio)
                            <option value="{{ $barrio->id }}"
                                {{ request('barrio_id') == $barrio->id ? 'selected' : '' }}>
                                {{ $barrio->nombre }}
                            </option>
                            @endforeach
                        </select>

                        <span>|</span>

                        <img src="{{ asset('images/casa.png') }}" alt="Tipo" width="20" height="20">

                        <select name="tipo" class="form-select border-0">
                            <option value="">Tipo</option>
                            <option value="casa" {{ request('tipo') == 'casa' ? 'selected' : '' }}>Casa</option>
                            <option value="departamento" {{ request('tipo') == 'departamento' ? 'selected' : '' }}>
                                Departamento</option>
                            <option value="cuarto" {{ request('tipo') == 'cuarto' ? 'selected' : '' }}>Cuarto</option>
                        </select>

                        <span>|</span>

                        <input type="number" name="precio" class="form-control border-0" placeholder="Precio max">

                        <span>|</span>

                        <input type="text" name="servicio" class="form-control border-0" placeholder="Servicios">

                    </div>

                    <button type="submit" class="btn rounded-circle ms-2">
                        <img src="{{ asset('images/busqueda.png') }}" alt="Buscar" width="20" height="20">
                    </button>

                </div>
            </form>
        </div>
    </section>

    <div class="container py-5">
        @if ($cuartos->isNotEmpty())
        <h3 class="mb-4">Cuartos</h3>

        <div class="d-flex align-items-center">

            <!-- Flecha izquierda -->
            <button class="btn btn-light shadow me-3 rounded-circle"
                onclick="scrollCarousel('cuartos', -300)">‹</button>

            <div id="cuartos" class="d-flex overflow-auto gap-4 w-100">
                @foreach ($cuartos as $cuarto)
                <x-card-propiedad :propiedad="$cuarto" />
                @endforeach

            </div>

            <!-- Flecha derecha -->
            <button class="btn btn-light shadow ms-3 rounded-circle" onclick="scrollCarousel('cuartos', 300)">›</button>

        </div>
        @endif

        @if ($casas->isNotEmpty())
        <h3>Casas</h3>

        <div class="d-flex align-items-center">

            <!-- Flecha izquierda -->
            <button class="btn btn-light shadow me-3 rounded-circle" onclick="scrollCarousel('casas', -300)">‹</button>

            <div id="casas" class="d-flex overflow-auto gap-4 w-100">
                @foreach ($casas as $casa)
                <x-card-propiedad :propiedad="$casa" />
                @endforeach

            </div>

            <!-- Flecha derecha -->
            <button class="btn btn-light shadow ms-3 rounded-circle" onclick="scrollCarousel('casas', 300)">›</button>
        </div>
        @endif

        @if ($departamentos->isNotEmpty())
        <h3>Departamentos</h3>

        <div class="d-flex align-items-center">

            <button class="btn btn-light shadow me-3 rounded-circle"
                onclick="scrollCarousel('departamentos', -300)">‹</button>

            <div id="departamentos" class="d-flex overflow-auto gap-4 w-100">
                @foreach ($departamentos as $departamento)
                <x-card-propiedad :propiedad="$departamento" />
                @endforeach

            </div>

            <!-- Flecha derecha -->
            <button class="btn btn-light shadow ms-3 rounded-circle"
                onclick="scrollCarousel('departamentos', 300)">›</button>
        </div>
        @endif

    </div>



</x-layout>
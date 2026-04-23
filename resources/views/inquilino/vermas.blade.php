<x-layout>

    <main class="container-fluid" title="Detalle de la propiedad seleccionada">
        <div class="container py-5">
            @php $fotos = $propiedad->imagenes; @endphp

            <div class="row mb-5">
                <div class="col-md-8">
                    <div class="row g-2" title="Galería de imágenes de la propiedad">

                        <div class="col-md-8">
                            @if ($fotos->count() > 0)
                            <img src="{{ asset('storage/' . $fotos[0]->ruta) }}" 
                                class="w-100 rounded shadow"
                                style="height:350px; object-fit:cover; cursor:pointer;" 
                                data-bs-toggle="modal"
                                data-bs-target="#modalCarrusel" 
                                data-bs-slide-to="0"
                                title="Imagen principal de la propiedad">
                            @else
                            <img src="{{ asset('images/no-image.png') }}" 
                                class="w-100 rounded shadow"
                                style="height:350px; object-fit:cover;"
                                title="Imagen no disponible">
                            @endif
                        </div>

                        <div class="col-md-4 d-flex flex-column gap-2">
                            @if ($fotos->count() > 1)
                            <img src="{{ asset('storage/' . $fotos[1]->ruta) }}" 
                                class="w-100 rounded shadow"
                                style="height:170px; object-fit:cover; cursor:pointer;" 
                                data-bs-toggle="modal"
                                data-bs-target="#modalCarrusel" 
                                data-bs-slide-to="1"
                                title="Imagen secundaria">
                            @endif
                            @if ($fotos->count() > 2)
                            <img src="{{ asset('storage/' . $fotos[2]->ruta) }}" 
                                class="w-100 rounded shadow"
                                style="height:170px; object-fit:cover; cursor:pointer;" 
                                data-bs-toggle="modal"
                                data-bs-target="#modalCarrusel" 
                                data-bs-slide-to="2"
                                title="Imagen adicional">
                            @endif
                        </div>

                        <div class="col-12 d-flex gap-2 mt-2">
                            @foreach ($fotos->slice(3, 3) as $index => $foto)
                            <img src="{{ asset('storage/' . $foto->ruta) }}" 
                                class="rounded shadow flex-fill"
                                style="height:110px; width:33%; object-fit:cover; cursor:pointer;"
                                data-bs-toggle="modal" 
                                data-bs-target="#modalCarrusel"
                                data-bs-slide-to="{{ $index + 3 }}"
                                title="Vista adicional de la propiedad">
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow border-0 p-4" style="margin-top:5px; border-radius:20px;" title="Información principal de la propiedad">
                        <h4 class="fw-bold mb-3" title="Título de la propiedad">{{ $propiedad->titulo }}</h4>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="fw-bold fs-5" title="Precio de renta">${{ number_format($propiedad->precio, 2) }}</div>
                        </div>

                        <p class="mb-1" title="Ubicación del barrio"><strong>Barrio:</strong></p>
                        <p class="text-muted" title="Nombre del barrio">{{ $propiedad->barrio->nombre }}</p>

                        <p class="mb-1" title="Dirección de la propiedad"><strong>Calle:</strong></p>
                        <p class="text-muted" title="Nombre de la calle">{{ $propiedad->calle }}</p>

                        <p class="mb-1" title="Método de pago"><strong>Forma de pago:</strong></p>
                        <p class="text-muted" title="Tipo de pago">{{ ucfirst($propiedad->forma_pago) }}</p>

                        @guest
                        <a href="{{ route('login', [ 'redirect' => url()->current()]) }}" 
                           class="btn boton"
                           title="Iniciar sesión para solicitar la propiedad">
                            Solicitud
                        </a>
                        @endguest

                        @auth
                        @if (auth()->user()->rol != 'propietario')
                        <a href="{{ route('solicitarpropiedad', $propiedad->id) }}" 
                           class="btn boton"
                           title="Enviar solicitud de renta">
                            Solicitud
                        </a>
                        @endif
                        @endauth
                    </div>
                </div>
            </div>

            <div class="row mb-5">
                <div class="col-md-8">
                    <div class="card border-0 shadow p-5" style="border-radius:25px;" title="Detalles completos de la propiedad">

                        <h4 class="fw-bold mb-3" title="Descripción del inmueble">Descripción General</h4>
                        <p class="text-muted" title="Información detallada">{{ $propiedad->descripcion }}</p>

                        <h4 class="fw-bold mt-4" title="Servicios incluidos">Servicios</h4>
                        <ul class="list-unstyled text-muted" title="Lista de servicios disponibles">
                            @php
                            $listaServicios = json_decode($propiedad->servicio, true)
                            @endphp

                            @foreach ($listaServicios as $item)
                            <li title="Servicio disponible">
                                <span class="badge rounded-pill bg-primary me-2"
                                    style="width: 8px; height: 8px; padding: 0;">&nbsp;</span>
                                {{ $item }}
                            </li>
                            @endforeach
                        </ul>

                        <h4 class="fw-bold mt-4" title="Ubicación cercana">Lugar de referencia</h4>
                        <p class="text-muted" title="Referencias cercanas">{{ $propiedad->cercanias ?? 'Sin referencia cercana registrada' }}</p>

                        <h4 class="fw-bold mt-4" title="Normas del inmueble">Reglas de convivencia</h4>
                        <div class="text-muted" title="Reglas de uso">
                            {!! nl2br(e($propiedad->reglas)) !!}
                        </div>

                    </div>
                </div>
            </div>

            <div class="mb-5">
                <h3 class="fw-bold mb-3" title="Ubicación en mapa">Mapa</h3>
                <div id="mapa-detalle" 
                     style="height:420px; border-radius:20px;" 
                     class="shadow"
                     title="Mapa de ubicación de la propiedad"></div>
            </div>

            <div class="row mb-5">
                <div class="col-md-8">
                    <h3 class="fw-bold mb-3" title="Opiniones de usuarios">Comentarios</h3>

                    <div class="card border-0 shadow-sm rounded-4 mb-3" title="Promedio de calificaciones">
                        <div class="card-body py-3">
                            <span class="fw-bold" title="Calificación promedio">
                                Promedio: {{ $review->count() > 0 ? number_format($review->avg('rating'), 1) : '0' }}
                                <i class="bi bi-star-fill text-warning"></i>
                            </span>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm rounded-4 mb-3" title="Lista de reseñas">
                        <div class="card-body">
                            <h6 class="fw-bold mb-3" title="Comentarios recientes">Reseñas recientes</h6>

                            @forelse($review as $item)
                            <div class="border-bottom mb-3 pb-3 position-relative" title="Comentario de usuario">

                                <div class="d-flex align-items-start gap-3">
                                    <img src="{{ optional($item->usuario)->avatar 
                                                ? asset('storage/' . $item->usuario->avatar) 
                                                : asset('images/user.svg') }}" 
                                        class="rounded-circle shadow-sm"
                                        style="width:45px; height:45px; object-fit:cover;"
                                        title="Foto de perfil">

                                    <div class="w-100">
                                        <div class="d-flex justify-content-between">
                                            <span class="fw-bold" title="Nombre del usuario">{{ $item->usuario->name ?? 'Usuario' }}</span>
                                            <small class="text-muted" title="Fecha del comentario">{{ $item->created_at->diffForHumans() }}</small>
                                        </div>

                                        <div class="text-warning small mb-1" title="Calificación otorgada">
                                            @for ($i = 1; $i <= 5; $i++) 
                                                <i class="bi bi-star{{ $i <= $item->rating ? '-fill' : '' }}"></i>
                                            @endfor
                                        </div>

                                        <p class="mb-1 text-secondary" title="Comentario del usuario">{{ $item->comentario }}</p>
                                    </div>
                                </div>

                                @if (auth()->id() === $item->user_id)
                                <div class="dropdown position-absolute top-0 end-0 m-2">
                                    <button class="btn btn-link text-muted p-0 border-0" 
                                        type="button"
                                        data-bs-toggle="dropdown"
                                        title="Opciones de comentario">
                                        <i class="bi bi-three-dots"></i>
                                    </button>

                                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3">
                                        <li>
                                            <a class="dropdown-item d-flex align-items-center py-2"
                                                href="{{ route('editreview', $item->id) }}"
                                                title="Editar comentario">
                                                <i class="bi bi-pencil me-2"></i>Editar
                                            </a>
                                        </li>
                                        <li>
                                            <form action="{{ route('destroyreview', $item->id) }}" method="POST">
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                    class="dropdown-item d-flex align-items-center text-danger py-2"
                                                    onclick="return confirm('¿Eliminar esta reseña?')"
                                                    title="Eliminar comentario">
                                                    <i class="bi bi-trash me-2"></i>Eliminar
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                                @endif

                            </div>
                            @empty
                            <p class="text-muted mb-0" title="Sin comentarios disponibles">Aún no hay reseñas. ¡Sé el primero en comentar!</p>
                            @endforelse
                        </div>
                    </div>

                    @auth
                    @php
                    $yaComento = $review->where('user_id', auth()->id())->first();
                    @endphp

                    @if (!$yaComento)
                    <form action="{{ route('review', $propiedad->id) }}" method="POST" title="Formulario para enviar reseña">
                        @csrf
                        <div class="mb-3">
                            <label class="small fw-bold" title="Seleccionar puntuación">Puntuación:</label>
                            <select name="rating" class="form-select border-0 shadow-sm rounded-3" required title="Califica la propiedad">
                                <option value="5">⭐⭐⭐⭐⭐ (Excelente)</option>
                                <option value="4">⭐⭐⭐⭐ (Bueno)</option>
                                <option value="3">⭐⭐⭐ (Regular)</option>
                                <option value="2">⭐⭐ (Malo)</option>
                                <option value="1">⭐ (Pésimo)</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <textarea name="comentario" 
                                class="form-control border-0 shadow-sm rounded-4" 
                                rows="3"
                                placeholder="Tu opinión..." 
                                required
                                title="Escribe tu comentario"></textarea>
                        </div>

                        <button type="submit" class="btn px-4 boton shadow-sm" title="Enviar reseña">
                            Enviar reseña
                        </button>
                    </form>
                    @else
                    <div class="alert alert-light border-0 shadow-sm rounded-4" title="Ya comentaste">
                        Ya has calificado esta propiedad.
                    </div>
                    @endif
                    @else
                    <p class="text-muted" title="Debes iniciar sesión">Inicia sesión para dejar un comentario.</p>
                    @endauth
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalCarrusel" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content bg-transparent border-0 text-center">
                    <div class="modal-body p-0 position-relative">
                        <button type="button" 
                                class="btn-close btn-close-white position-absolute top-0 end-0 m-3 z-3"
                                data-bs-dismiss="modal"
                                title="Cerrar visor"></button>

                        <div id="carruselZoom" class="carousel slide" data-bs-interval="false">
                            <div class="carousel-inner">
                                @foreach ($fotos as $index => $foto)
                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                    <img src="{{ asset('storage/' . $foto->ruta) }}" 
                                         class="img-fluid rounded shadow"
                                         style="max-height: 90vh;"
                                         title="Imagen ampliada">
                                </div>
                                @endforeach
                            </div>

                            @if ($fotos->count() > 1)
                            <button class="carousel-control-prev" type="button" data-bs-target="#carruselZoom" data-bs-slide="prev" title="Imagen anterior">
                                <span class="carousel-control-prev-icon"></span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carruselZoom" data-bs-slide="next" title="Siguiente imagen">
                                <span class="carousel-control-next-icon"></span>
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>


    <script>
    function initMap() {
        const ubicacion = {
            lat: {{ $propiedad->latitud ?? 20.2114 }},
            lng: {{ $propiedad->longitud ?? -87.4653 }}
        };

        const mapa = new google.maps.Map(document.getElementById("mapa-detalle"), {
            zoom: 15,
            center: ubicacion
        });

        const info = new google.maps.InfoWindow({
        content: `<strong>{{ $propiedad->titulo }}</strong><br>{{ $propiedad->calle }}`
        });

        const marcador = new google.maps.Marker({
            position: ubicacion,
            map: mapa,
            title: "{{ $propiedad->titulo }}"
        });

        marcador.addListener("click", () => {
            info.open(mapa, marcador);
        });
    }
</script>

    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAmG2X4PGYv8RhBMdi4734J-u_L9h9pEo&callback=initMap">
    </script>

</x-layout>
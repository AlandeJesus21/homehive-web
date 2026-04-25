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
                        <h4 class="fw-bold mb-3">{{ $propiedad->titulo }}</h4>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="fw-bold fs-5">${{ number_format($propiedad->precio, 2) }}</div>
                        </div>

                        <p class="mb-1"><strong>Barrio:</strong></p>
                        <p class="text-muted">{{ $propiedad->barrio->nombre }}</p>

                        <p class="mb-1"><strong>Calle:</strong></p>
                        <p class="text-muted">{{ $propiedad->calle }}</p>

                        <p class="mb-1"><strong>Forma de pago:</strong></p>
                        <p class="text-muted">{{ ucfirst($propiedad->forma_pago) }}</p>

                        @guest
                        <a href="{{ route('login', [ 'redirect' => url()->current()]) }}" 
                        class="btn boton w-100"
                        style="background-color: #1E3A8A; color: white; border: 1px solid #1E3A8A;">
                            Solicitud
                        </a>
                        @endguest

                        @auth
                        @if (auth()->user()->rol != 'propietario')
                        <a href="{{ route('solicitarpropiedad', $propiedad->id) }}" 
                        class="btn boton w-100"
                        style="background-color: #1E3A8A; color: white; border: 1px solid #1E3A8A;">
                            Solicitud
                        </a>
                        @endif
                        @endauth
                    </div>
                </div>
            </div>

            <div class="row mb-5">
                <div class="col-md-8">
                    <div class="card border-0 shadow p-5" style="border-radius:25px;">
                        <h4 class="fw-bold mb-3">Descripción General</h4>
                        <p class="text-muted">{{ $propiedad->descripcion }}</p>

                        <h4 class="fw-bold mt-4">Servicios</h4>
                        <ul class="list-unstyled text-muted">
                            @php $listaServicios = json_decode($propiedad->servicio, true) @endphp
                            @if($listaServicios)
                                @foreach ($listaServicios as $item)
                                <li>
                                    <span class="badge rounded-pill bg-primary me-2" style="width: 8px; height: 8px; padding: 0;">&nbsp;</span>
                                    {{ $item }}
                                </li>
                                @endforeach
                            @endif
                        </ul>

                        <h4 class="fw-bold mt-4">Lugar de referencia</h4>
                        <p class="text-muted">{{ $propiedad->cercanias ?? 'Sin referencia registrada' }}</p>

                        <h4 class="fw-bold mt-4">Reglas de convivencia</h4>
                        <div class="text-muted">{!! nl2br(e($propiedad->reglas)) !!}</div>
                    </div>
                </div>
            </div>

            <div class="mb-5">
                <h3 class="fw-bold mb-3">Mapa</h3>
                <div id="mapa-detalle" style="height:420px; border-radius:20px;" class="shadow"></div>
            </div>

            <div class="row mb-5">
                <div class="col-md-8">
                    <h3 class="fw-bold mb-3">Comentarios</h3>

                    <div class="card border-0 shadow-sm rounded-4 mb-3">
                        <div class="card-body py-3">
                            <span class="fw-bold">
                                Promedio: {{ $review->count() > 0 ? number_format($review->avg('rating'), 1) : '0' }}
                                <i class="bi bi-star-fill text-warning"></i>
                            </span>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm rounded-4 mb-3">
                        <div class="card-body">
                            <h6 class="fw-bold mb-3">Reseñas recientes</h6>

                            @forelse($review as $item)
                            <div class="border-bottom mb-3 pb-3 position-relative">
                                <div class="d-flex align-items-start gap-3">
                                    <img src="{{ optional($item->usuario)->avatar 
                                                ? asset('storage/' . $item->usuario->avatar) 
                                                : asset('images/user.svg') }}" 
                                        class="rounded-circle shadow-sm"
                                        style="width:45px; height:45px; object-fit:cover;">

                                    <div class="w-100">
                                        <div class="d-flex justify-content-between">
                                            <span class="fw-bold">{{ $item->usuario->name ?? 'Usuario' }}</span>
                                            <small class="text-muted">{{ $item->created_at->diffForHumans() }}</small>
                                        </div>

                                        <div class="text-warning small mb-1">
                                            @for ($i = 1; $i <= 5; $i++) 
                                                <i class="bi bi-star{{ $i <= $item->rating ? '-fill' : '' }}"></i>
                                            @endfor
                                        </div>
                                        <p class="mb-1 text-secondary">{{ $item->comentario }}</p>
                                    </div>
                                </div>

                                @if (auth()->id() === $item->user_id)
                                <div class="dropdown position-absolute top-0 end-0 m-2">
                                    <button class="btn btn-link text-muted p-0 border-0" type="button" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3">
                                        <li><a class="dropdown-item d-flex align-items-center py-2" href="{{ route('editreview', $item->id) }}"><i class="bi bi-pencil me-2"></i>Editar</a></li>
                                        <li>
                                            <form action="{{ route('destroyreview', $item->id) }}" method="POST">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="dropdown-item d-flex align-items-center text-danger py-2" onclick="return confirm('¿Eliminar esta reseña?')">
                                                    <i class="bi bi-trash me-2"></i>Eliminar
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                                @endif
                            </div>
                            @empty
                            <p class="text-muted mb-0">Aún no hay reseñas. ¡Sé el primero en comentar!</p>
                            @endforelse
                        </div>
                    </div>

                    @auth
                        @php $yaComento = $review->where('user_id', auth()->id())->first(); @endphp
                        @if (!$yaComento)
                        <form action="{{ route('review', $propiedad->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="small fw-bold">Puntuación:</label>
                                <select name="rating" class="form-select border-0 shadow-sm rounded-3" required>
                                    <option value="5">⭐⭐⭐⭐⭐ (Excelente)</option>
                                    <option value="4">⭐⭐⭐⭐ (Bueno)</option>
                                    <option value="3">⭐⭐⭐ (Regular)</option>
                                    <option value="2">⭐⭐ (Malo)</option>
                                    <option value="1">⭐ (Pésimo)</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <textarea name="comentario" class="form-control border-0 shadow-sm rounded-4" rows="3" placeholder="Tu opinión..." required></textarea>
                            </div>
                            <button type="submit" class="btn px-4 boton shadow-sm" style="background-color: #f3e2e2; color: #5a1a1a; border: 1px solid #5a1a1a;">Enviar reseña</button>
                        </form>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </main>

    <div class="modal fade" id="modalCarrusel" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content bg-transparent border-0 text-center">
                <div class="modal-body p-0 position-relative">
                    <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3 z-3" data-bs-dismiss="modal"></button>
                    <div id="carruselZoom" class="carousel slide" data-bs-interval="false">
                        <div class="carousel-inner">
                            @foreach ($fotos as $index => $foto)
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                <img src="{{ asset('storage/' . $foto->ruta) }}" class="img-fluid rounded shadow" style="max-height: 90vh;">
                            </div>
                            @endforeach
                        </div>
                        @if ($fotos->count() > 1)
                        <button class="carousel-control-prev" type="button" data-bs-target="#carruselZoom" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span></button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carruselZoom" data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    function initMap() {
        const ubicacion = { lat: {{ $propiedad->latitud ?? 20.2114 }}, lng: {{ $propiedad->longitud ?? -87.4653 }} };
        const mapa = new google.maps.Map(document.getElementById("mapa-detalle"), { zoom: 15, center: ubicacion });
        const marcador = new google.maps.Marker({ position: ubicacion, map: mapa, title: "{{ $propiedad->titulo }}" });
    }
<<<<<<< Updated upstream
=======
</script>

    <script async defer
        <!-- src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDw7lhTRLQ6R2Hfd5--jj3goydB0ysifys&callback=initMap"> -->
>>>>>>> Stashed changes
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAmG2X4PGYv8RhBMdi4734J-u_L9h9pEo&callback=initMap"></script>
</x-layout>
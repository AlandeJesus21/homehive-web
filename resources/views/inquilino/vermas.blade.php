<x-inquilino.layout>

    <main class="container-fluid">
        <div class="container py-5 ">
            @php $fotos = $propiedad->imagenes; @endphp

            <div class="row mb-5">
                <div class="col-md-8">
                    <div class="row g-2">

                        <div class="col-md-8">
                            @if ($fotos->count() > 0)
                                <img src="{{ asset('storage/' . $fotos[0]->ruta) }}" class="w-100 rounded shadow"
                                    style="height:350px; object-fit:cover; cursor:pointer;" data-bs-toggle="modal"
                                    data-bs-target="#modalCarrusel" data-bs-slide-to="0">
                            @else
                                <img src="{{ asset('images/no-image.png') }}" class="w-100 rounded shadow"
                                    style="height:350px; object-fit:cover;">
                            @endif
                        </div>


                        <div class="col-md-4 d-flex flex-column gap-2">
                            @if ($fotos->count() > 1)
                                <img src="{{ asset('storage/' . $fotos[1]->ruta) }}" class="w-100 rounded shadow"
                                    style="height:170px; object-fit:cover; cursor:pointer;" data-bs-toggle="modal"
                                    data-bs-target="#modalCarrusel" data-bs-slide-to="1">
                            @endif
                            @if ($fotos->count() > 2)
                                <img src="{{ asset('storage/' . $fotos[2]->ruta) }}" class="w-100 rounded shadow"
                                    style="height:170px; object-fit:cover; cursor:pointer;" data-bs-toggle="modal"
                                    data-bs-target="#modalCarrusel" data-bs-slide-to="2">
                            @endif
                        </div>


                        <div class="col-12 d-flex gap-2 mt-2">
                            @foreach ($fotos->slice(3, 3) as $index => $foto)
                                <img src="{{ asset('storage/' . $foto->ruta) }}" class="rounded shadow flex-fill"
                                    style="height:110px; width:33%; object-fit:cover; cursor:pointer;"
                                    data-bs-toggle="modal" data-bs-target="#modalCarrusel"
                                    data-bs-slide-to="{{ $index + 3 }}">
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow border-0 p-4 sticky-top" style="top:100px; border-radius:20px;">
                        <h4 class="fw-bold mb-3">{{ $propiedad->titulo }}</h4>

                        <div class="d-flex justify-content-between align-items-center mb-3">

                            <div class="fw-bold fs-5">${{ number_format($propiedad->precio, 2) }}</div>
                        </div>

                        <p class="mb-1"><strong>Barrio:</strong></p>
                        <p class="text-muted">{{ $propiedad->barrio }}</p>

                        <p class="mb-1"><strong>Calle:</strong></p>
                        <p class="text-muted">{{ $propiedad->calle }}</p>

                        <p class="mb-1"><strong>Forma de pago:</strong></p>
                        <p class="text-muted">{{ ucfirst($propiedad->forma_pago) }}</p>

                        <a href="{{ route('solicitarpropiedad', $propiedad->id) }}" class="btn boton">
                            Solicitud
                        </a>
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
                            @php
                                $listaServicios = array_filter(array_map('trim', explode(',', $propiedad->servicio)));
                            @endphp

                            @foreach ($listaServicios as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>

                        <h4 class="fw-bold mt-4">Lugar de referencia</h4>
                        <p class="text-muted">{{ $propiedad->cercanias ?? 'Sin referencia cercana registrada' }}</p>

                        <h4 class="fw-bold mt-4">Reglas de convivencia</h4>
                        <div class="text-muted">
                            {!! nl2br(e($propiedad->reglas)) !!}
                        </div>

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
                                <div class="border-bottom mb-3 pb-2">
                                    <div class="d-flex justify-content-between">
                                        <span class="fw-bold">{{ $item->usuario->name }}</span>
                                        <small class="text-muted">{{ $item->created_at->diffForHumans() }}</small>
                                    </div>
                                    <div class="text-warning small mb-1">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="bi bi-star{{ $i <= $item->rating ? '-fill' : '' }}"></i>
                                        @endfor
                                    </div>
                                    <p class="mb-1 text-secondary">{{ $item->comentario }}</p>

                                    @if (auth()->id() === $item->user_id)
                                        <div class="dropdown position-absolute top-0 end-0 m-3">
                                            <button class="btn btn-link text-muted p-0 border-0" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical fs-5"><svg
                                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-three-dots"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3" />
                                                    </svg></i>
                                            </button>

                                            <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3">
                                                <li>
                                                    <a class="dropdown-item d-flex align-items-center py-2"
                                                        href="{{ route('editreview', $item->id) }}">
                                                        <i class="bi bi-pencil me-2"></i> <svg
                                                            xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor" class="bi bi-pencil"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325" />
                                                        </svg>Editar
                                                    </a>
                                                </li>
                                                <li>
                                                    <form action="{{ route('destroyreview', $item->id) }}"
                                                        method="POST" id="delete-form-{{ $item->id }}">
                                                        @csrf @method('DELETE')
                                                        <button type="submit"
                                                            class="dropdown-item d-flex align-items-center text-danger py-2"
                                                            onclick="return confirm('¿Eliminar esta reseña?')">
                                                            <i class="bi bi-trash me-2"></i> <svg
                                                                xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor"
                                                                class="bi bi-trash3" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                                                            </svg>Eliminar
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
                        @php
                            $yaComento = $review->where('user_id', auth()->id())->first();
                        @endphp

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
                                    <textarea name="comentario" class="form-control border-0 shadow-sm rounded-4" rows="3"
                                        placeholder="Tu opinión..." required></textarea>
                                </div>

                                <button type="submit" class="btn px-4 boton shadow-sm">
                                    Enviar reseña
                                </button>
                            </form>
                        @else
                            <div class="alert alert-light border-0 shadow-sm rounded-4">
                                Ya has calificado esta propiedad.
                            </div>
                        @endif
                    @else
                        <p class="text-muted">Inicia sesión para dejar un comentario.</p>
                    @endauth
                </div>
            </div>
        </div>

        </div>


        </div>


        <div class="modal fade" id="modalCarrusel" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content bg-transparent border-0 text-center">
                    <div class="modal-body p-0 position-relative">
                        <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3 z-3"
                            data-bs-dismiss="modal" aria-label="Close"></button>

                        <div id="carruselZoom" class="carousel slide" data-bs-interval="false">
                            <div class="carousel-inner">
                                @foreach ($fotos as $index => $foto)
                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                        <img src="{{ asset('storage/' . $foto->ruta) }}"
                                            class="img-fluid rounded shadow" style="max-height: 90vh;">
                                    </div>
                                @endforeach
                            </div>

                            @if ($fotos->count() > 1)
                                <button class="carousel-control-prev" type="button" data-bs-target="#carruselZoom"
                                    data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon"></span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carruselZoom"
                                    data-bs-slide="next">
                                    <span class="carousel-control-next-icon"></span>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>

</x-inquilino.layout>

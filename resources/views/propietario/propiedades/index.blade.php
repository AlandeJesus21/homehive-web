<x-propietario.layout>

    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Propiedades</h2>

            @if($propiedades->count() > 0)
            <a href="{{ route('propiedades.create') }}" class="btn btn-primary shadow-sm">
                Publicar propiedad
            </a>
            @endif
        </div>

        @if($propiedades->isEmpty())

        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <p class="fs-3 mt-5 mb-5">
                    Todo gran cambio empieza con un buen lugar.
                    Integre su propiedad a HomeHive y conéctela
                    con quienes buscan su próximo hogar.
                </p>
                <a href="{{ route('propiedades.create') }}" class="btn btn-primary btn-lg shadow-sm">
                    Publicar propiedad
                </a>
            </div>
        </div>
        @else
        <div class="row">
            @foreach($propiedades as $propiedad)
            <div class="col-md-4 mb-4">

                <div class="card border-0 shadow-lg" style="border-radius: 25px; overflow: hidden;">
                    <div class="card-header bg-white border-0 pt-3 text-center">
                        <h5 class="fw-bold mb-0">{{ $propiedad->tipo }}</h5>
                    </div>


                    @if($propiedad->imagenes->count() > 0)
                    <img src="{{ asset('storage/' . $propiedad->imagenes->first()->ruta) }}" class="card-img-top"
                        style="height: 200px; object-fit: cover;">
                    @else
                    <div class="bg-light text-muted d-flex align-items-center justify-content-center"
                        style="height: 200px;">
                        Sin imagen disponible
                    </div>
                    @endif

                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="fw-bold fs-5">${{ number_format($propiedad->precio) }}</span>
                            <span class="text-muted small">0.0 ★</span>
                        </div>
                        <p class="mb-0 fw-bold">{{ $propiedad->titulo }}</p>
                        <p class="text-muted small mb-3">{{ $propiedad->nombre, $propiedad->calle }}</p>


                        <div class="row g-2">
                            <div class="col-6">
                                <a href="{{ route('propiedades.edit', $propiedad->id) }}"
                                    class="btn btn-outline-secondary w-100 btn-sm d-flex align-items-center justify-content-center">
                                    <i class="bi bi-pencil me-1"></i> Editar
                                </a>
                            </div>
                            <div class="col-6">

                                <button
                                    class="btn btn-outline-secondary w-100 btn-sm d-flex align-items-center justify-content-center">
                                    <i class="bi bi-chat-dots me-1"></i> Comentarios
                                </button>
                            </div>
                            <div class="col-6">
                                <a href="{{ route('propiedades.show', $propiedad->id) }}"
                                    class="btn btn-outline-secondary w-100 btn-sm d-flex align-items-center justify-content-center">
                                    <i class="bi bi-house me-1"></i> Ver
                                </a>
                            </div>
                            <div class="col-6">
                                <form action="{{ route('propiedades.destroy', $propiedad->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="btn btn-outline-danger w-100 btn-sm d-flex align-items-center justify-content-center"
                                        onclick="return confirm('¿Seguro que quieres eliminar esta propiedad de HomeHive?')">
                                        <i class="bi bi-trash me-1"></i> Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>


</x-propietario.layout>
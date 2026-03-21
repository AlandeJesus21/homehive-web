<x-layout>

    <div class="container py-4">

        <h3 class="fw-bold mb-3">Comentarios sobre la aplicación</h3>

        <ul class="nav nav-tabs mb-4">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Comentarios</a>
            </li>
        </ul>

        <div class="row justify-content-center">
            <div class="col-lg-10">

                <div class="card border-0 shadow-sm p-3 mb-4">
                    <h4 class="fw-bold">
                        Promedio de reseñas:
                        <span class="text-warning">
                            {{ number_format($reviews->avg('rating'), 1) ?? '0.0' }} ★
                        </span>
                    </h4>
                </div>

                <!-- LISTA DE COMENTARIOS -->
                <div class="card border-0 shadow-sm p-3 mb-4">
                    <h5 class="fw-bold">Reseñas recientes</h5>

                    @forelse ($reviews as $review)
                    <div class="border-bottom py-3">
                        <div class="d-flex justify-content-between">
                            <strong>{{ $review->usuario->name }}</strong>
                            <span class="text-warning">
                                {{ str_repeat('★', $review->rating) }}
                            </span>
                        </div>
                        <p class="mb-1">{{ $review->comentario }}</p>
                        <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                    </div>
                    @empty
                    <p class="text-muted">Aún no hay comentarios sobre la aplicación.</p>
                    @endforelse
                </div>

                @auth
                <div class="card border-0 shadow-sm p-3 mb-4">
                    <h5 class="fw-bold">Deja tu comentario</h5>

                    <form action="/save_review" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Calificación</label>
                            <select name="rating" class="form-select" required>
                                <option value="">Selecciona</option>
                                <option value="5">★★★★★</option>
                                <option value="4">★★★★</option>
                                <option value="3">★★★</option>
                                <option value="2">★★</option>
                                <option value="1">★</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Comentario</label>
                            <textarea name="comentario" class="form-control" rows="3" required></textarea>
                        </div>

                        <button class="btn btn-primary">
                            Publicar comentario
                        </button>
                    </form>
                </div>
                @endauth

            </div>
        </div>
    </div>

</x-layout>
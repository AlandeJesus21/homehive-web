<x-layout>
<main class="content-fluid" title="Sección de edición de comentarios y reseñas">
    <div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3 class="fw-bold mb-4" title="Listado de comentarios">Comentarios</h3>

            <div class="card border-0 shadow-sm rounded-4 mb-3" title="Promedio de calificaciones">
                <div class="card-body py-3">
                    <span class="fw-bold" title="Calificación promedio de la reseña">Promedio: {{ number_format($review->rating, 1) }}</span>
                </div>
            </div>

            <div class="card border-2 shadow-sm rounded-4 p-3" style="border-radius: 20px !important;" title="Formulario para editar reseña">
                <div class="card-body">
                    <h6 class="fw-bold mb-3" title="Modificar tu reseña">Edita tu reseña</h6>

                    <form action="{{ route('updatereview', $review->id) }}" method="POST" title="Formulario de actualización de reseña">
                        @csrf
                        @method('PUT')

                        <div class="mb-3 position-relative">
                            <select name="rating" class="form-select border shadow-sm rounded-3 py-2" title="Seleccionar calificación">
                                <option value="5" title="Excelente - 5 estrellas" {{ $review->rating == 5 ? 'selected' : '' }}>⭐⭐⭐⭐⭐</option>
                                <option value="4" title="Muy bueno - 4 estrellas" {{ $review->rating == 4 ? 'selected' : '' }}>⭐⭐⭐⭐</option>
                                <option value="3" title="Regular - 3 estrellas" {{ $review->rating == 3 ? 'selected' : '' }}>⭐⭐⭐</option>
                                <option value="2" title="Malo - 2 estrellas" {{ $review->rating == 2 ? 'selected' : '' }}>⭐⭐</option>
                                <option value="1" title="Muy malo - 1 estrella" {{ $review->rating == 1 ? 'selected' : '' }}>⭐</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <textarea name="comentario" 
                                      class="form-control border shadow-sm rounded-3" 
                                      rows="3" 
                                      placeholder="Tu opinión..." 
                                      title="Escribe tu comentario sobre la propiedad">{{ old('comentario', $review->comentario) }}</textarea>
                        </div>

                        <button type="submit" 
                                class="btn btn-primary px-4 fw-bold" 
                                style="background-color: #1a3a8a; border-radius: 10px;"
                                title="Guardar cambios de la reseña">
                            Guardar reseña
                        </button>

                        <a href="{{ url()->previous() }}" 
                           class="btn btn-link text-muted text-decoration-none small ms-2"
                           title="Cancelar edición y regresar">
                           Cancelar
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</main>
</x-layout>
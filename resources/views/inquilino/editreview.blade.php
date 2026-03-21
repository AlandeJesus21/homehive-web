<x-inquilino.layout>
<div class="comentarios">
                            <div class="container custom-width">
                                <div class="comentarios-encabezado">
                                    <h2 class="section-title">Comentarios</h2>
                                </div>


                                        <div class="custom-card p-4">
                                            <h6 class="fw-bold mb-3">Deja tu reseña</h6>
                                            <form action="{{ route('comentarios.store') }}" method="POST">
                                                @csrf
                                                {{-- Campo oculto para saber a qué propiedad pertenece el comentario --}}
                                                <input type="hidden" name="propiedad_id" value="{{ $propiedad->id }}">

                                                <div class="mb-3">
                                                    <select name="calificacion" class="form-select border-light-subtle"
                                                        required>
                                                        <option value="5">⭐⭐⭐⭐⭐</option>
                                                        <option value="4">⭐⭐⭐⭐</option>
                                                        <option value="3">⭐⭐⭐</option>
                                                        <option value="2">⭐⭐</option>
                                                        <option value="1">⭐</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <textarea name="contenido" class="form-control" rows="3" placeholder="Tu opinión..." required></textarea>
                                                </div>
                                                <button type="submit" class="btn px-4" id="resenia">Guardar
                                                    reseña</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

</x-inquilino.layout>

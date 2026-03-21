<x-propietario.layout>

<div class="container-fluid px-0">
    <div class="row g-0">

        
        <div class="col-md-7 d-none d-md-block position-sticky top-0 p-0" style="height:100vh;">
            <img src="{{ asset('images/viejitoEdit.png') }}"
                 class="w-100 h-100"
                 style="object-fit:cover; object-position:30% center;">
        </div>

        
        <div class="col-md-5 d-flex justify-content-center py-3 bg-light">
            <div class="card shadow-lg p-4 my-3" style="width:100%; max-width:500px; border-radius:15px; border:none;">

                <h2 class="mb-4 fw-bold text-center">Modificación de propiedades</h2>

                <form method="POST" action="{{ route('propiedades.update', $propiedad->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nombre de la propiedad:</label>
                        <input type="text" class="form-control" name="titulo" value="{{ $propiedad->titulo }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Precio:</label>
                        <input type="number" class="form-control" name="precio" value="{{ $propiedad->precio }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tipo:</label>
                        <select class="form-select" name="tipo" required>
                            <option value="cuarto" {{ $propiedad->tipo == 'cuarto' ? 'selected' : '' }}>Cuarto</option>
                            <option value="casa" {{ $propiedad->tipo == 'casa' ? 'selected' : '' }}>Casa</option>
                            <option value="departamento" {{ $propiedad->tipo == 'departamento' ? 'selected' : '' }}>Departamento</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Reglamento:</label>
                        <input type="text" class="form-control" name="reglas" value="{{ $propiedad->reglas }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Descripción:</label>
                        <input type="text" class="form-control" name="descripcion" value="{{ $propiedad->descripcion }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold d-block">Imagenes actuales:</label>
                        <div class="d-flex flex-wrap gap-2 mb-3">
                            @foreach($propiedad->imagenes as $img)
                                <div class="position-relative" id="foto-{{ $img->id }}">
                                    <img src="{{ asset('storage/' . $img->ruta) }}"
                                         class="rounded shadow-sm border"
                                         style="width:75px; height:75px; object-fit:cover;">

                                    
                                    <button type="button"
                                            onclick="eliminarImagen({{ $img->id }})"
                                            class="position-absolute top-0 end-0 border-0 bg-danger text-white d-flex align-items-center justify-content-center shadow-sm"
                                            style="width: 18px; height: 18px; border-radius: 50%; margin: -5px; font-size: 12px; line-height: 1;">
                                        &times;
                                    </button>
                                </div>
                            @endforeach
                        </div>

                        <label class="form-label fw-semibold">Cambiar imagenes:</label>
                        <input type="file" class="form-control" name="imagenes[]" accept="image/*" multiple>
                    </div>

                    <button type="submit" class="btn w-100 btn-lg text-white mt-3" style="background-color: #2b4581; border-radius: 8px; font-weight: medium;">
                        Guardar cambios
                    </button>

                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function eliminarImagen(id) {
        if (confirm('¿Deseas eliminar esta imagen?')) {
            fetch(`/propiedades/foto/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => {
                if (response.ok) {
                    document.getElementById(`foto-${id}`).remove();
                }
            });
        }
    }
</script>

</x-propietario.layout>

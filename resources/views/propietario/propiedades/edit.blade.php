<div style="background: linear-gradient(180deg,  #D2D4E5 40%, #B0B3D3 100%); min-height: 100vh; padding: 0px 0; font-family: 'Segoe UI', sans-serif;">

<x-propietario.layout>

<div class="container-fluid px-0">
    <div class="row g-0">

        {{-- IMAGEN --}}
        <div class="col-md-7 d-none d-md-block position-sticky top-0 p-0" style="height:100vh;">
            <img src="{{ asset('images/viejitoEdit.png') }}"
                 class="w-100 h-100"
                 style="object-fit:cover; object-position:30% center;">
        </div>

        {{-- FORM --}}
        <div class="col-md-5 d-flex flex-column align-items-center py-3">
            
            <div class="card shadow-lg p-4 my-3" style="width:100%; max-width:500px; border-radius:15px; border:none;">

                <h2 class="mb-4 fw-bold text-center">Modificación de propiedades</h2>

                {{-- ERRORES --}}
                @if ($errors->any())
                    <div class="mb-3" style="background:#fff; border-radius:12px; padding:12px;">
                        <ul style="margin:0; padding-left:18px; color:#b02a37;">
                            @foreach ($errors->all() as $error)
                                <li style="font-size:14px;">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @php
                    $serviciosSeleccionados = json_decode($propiedad->servicio, true) ?? [];
                @endphp

                <form method="POST" action="{{ route('propiedades.update', $propiedad->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- TITULO --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nombre de la propiedad:</label>
                        <input type="text" class="form-control" name="titulo" value="{{ $propiedad->titulo }}" required>
                    </div>

                    {{-- PRECIO --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Precio:</label>
                        <input type="number" class="form-control" name="precio" value="{{ $propiedad->precio }}" required>
                    </div>

                    {{-- TIPO --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tipo:</label>
                        <select class="form-select" name="tipo" required>
                            <option value="cuarto" {{ $propiedad->tipo == 'cuarto' ? 'selected' : '' }}>Cuarto</option>
                            <option value="casa" {{ $propiedad->tipo == 'casa' ? 'selected' : '' }}>Casa</option>
                            <option value="departamento" {{ $propiedad->tipo == 'departamento' ? 'selected' : '' }}>Departamento</option>
                        </select>
                    </div>

                    {{-- SERVICIOS --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Servicios:</label>

                        <div class="border rounded-3 p-3" style="max-height:250px; overflow:auto; background:#f8f9fc;">

                            <p class="fw-bold mb-2">Servicios básicos</p>
                            @foreach([
                                'wifi' => 'WiFi / Internet',
                                'agua' => 'Agua',
                                'luz' => 'Luz',
                                'gas' => 'Gas',
                                'basura' => 'Recolección de basura'
                            ] as $value => $label)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="servicios[]" value="{{ $value }}"
                                        {{ in_array($value, $serviciosSeleccionados) ? 'checked' : '' }}>
                                    <label class="form-check-label">{{ $label }}</label>
                                </div>
                            @endforeach

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
                                    <input class="form-check-input" type="checkbox" name="servicios[]" value="{{ $value }}"
                                        {{ in_array($value, $serviciosSeleccionados) ? 'checked' : '' }}>
                                    <label class="form-check-label">{{ $label }}</label>
                                </div>
                            @endforeach

                            <p class="fw-bold mt-3 mb-2">Mobiliario</p>
                            @foreach([
                                'escritorio' => 'Escritorio y silla',
                                'closet' => 'Clóset',
                                'frigobar' => 'Frigobar',
                                'parrilla' => 'Parrilla'
                            ] as $value => $label)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="servicios[]" value="{{ $value }}"
                                        {{ in_array($value, $serviciosSeleccionados) ? 'checked' : '' }}>
                                    <label class="form-check-label">{{ $label }}</label>
                                </div>
                            @endforeach

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
                                    <input class="form-check-input" type="checkbox" name="servicios[]" value="{{ $value }}"
                                        {{ in_array($value, $serviciosSeleccionados) ? 'checked' : '' }}>
                                    <label class="form-check-label">{{ $label }}</label>
                                </div>
                            @endforeach

                        </div>
                    </div>

                    {{-- REGLAS --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Reglamento:</label>
                        <input type="text" class="form-control" name="reglas" value="{{ $propiedad->reglas }}" required>
                    </div>

                    {{-- DESCRIPCION --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Descripción:</label>
                        <input type="text" class="form-control" name="descripcion" value="{{ $propiedad->descripcion }}" required>
                    </div>

                    {{-- IMAGENES --}}
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
                                            style="width: 18px; height: 18px; border-radius: 50%; margin: -5px; font-size: 12px;">
                                        &times;
                                    </button>
                                </div>
                            @endforeach
                        </div>

                        <label class="form-label fw-semibold">Agregar nuevas imágenes:</label>

                        <input type="file"
                            id="imagenesInput"
                            class="form-control"
                            name="imagenes[]"
                            accept="image/*"
                            multiple>

                        <input type="hidden" name="imagenes_eliminadas" id="imagenes_eliminadas">
                    </div>

                    <button type="submit" class="btn w-100 btn-lg text-white mt-3"
                        style="background-color: #2b4581; border-radius: 8px;">
                        Guardar cambios
                    </button>

                </form>
            </div>
        </div>
    </div>
</div>

{{-- JS --}}
<script>
document.addEventListener('DOMContentLoaded', function() {

    const form = document.querySelector('form[action*="propiedades"]');

    form.addEventListener('submit', function(e) {

        let valid = true;

        const campos = [
            'titulo','tipo','barrio_id','calle',
            'precio','forma_pago','descripcion','reglas','cercanias'
        ];

        campos.forEach(name => {
            const input = document.querySelector(`[name="${name}"]`);
            if (!input.value.trim()) {
                valid = false;
            }
        });

        const servicios = document.querySelectorAll('[name="servicios[]"]:checked');
        if (servicios.length === 0) valid = false;

        const lat = document.getElementById("latitud").value;
        const lng = document.getElementById("longitud").value;

        if (!lat || !lng) valid = false;

        const imagenes = document.getElementById('imagenesInput');

        if (imagenes.files.length === 0 || imagenes.files.length > 6) {
            valid = false;
            alert('Debes subir entre 1 y 6 imágenes');
        }

        if (!valid) {
            e.preventDefault();
            alert('Completa correctamente todos los campos');
        }
    });

});
</script>

        <script>
        document.addEventListener('DOMContentLoaded', () => {

            const form = document.querySelector('form[action*="propiedades"]');
            const inputImagenes = form.querySelector('input[type="file"]');

            if (inputImagenes) {
                inputImagenes.addEventListener('change', function() {

                    const actuales = document.querySelectorAll('[id^="foto-"]').length;
                    const nuevas = this.files.length;

                    if ((actuales + nuevas) > 6) {
                        this.value = '';
                        alert('Máximo 6 imágenes por propiedad');
                    }
                });
            }

        });
        </script>

        <script>
        document.querySelector('form[action*="propiedades"]').addEventListener('submit', function(e) {

            const titulo = document.querySelector('[name="titulo"]').value.trim();
            const precio = document.querySelector('[name="precio"]').value.trim();
            const reglas = document.querySelector('[name="reglas"]').value.trim();
            const descripcion = document.querySelector('[name="descripcion"]').value.trim();
            const servicios = document.querySelectorAll('[name="servicios[]"]:checked');

            if (!titulo || !precio || !reglas || !descripcion || servicios.length === 0) {
                e.preventDefault();
                alert('Completa todos los campos y selecciona al menos un servicio.');
            }

        });
    
        </script>

        <script>
                let eliminadas = [];

                function eliminarImagen(id) {
                    const foto = document.getElementById('foto-' + id);

                    if (!foto) return;

                    foto.remove();
                    eliminadas.push(id);

                    document.getElementById('imagenes_eliminadas').value = eliminadas.join(',');
                }
                </script>


<script>
document.querySelector('form[action*="propiedades"]').addEventListener('submit', function(e) {

    const actuales = document.querySelectorAll('[id^="foto-"]').length;
    const nuevas = document.getElementById('imagenesInput').files.length;

    const total = actuales + nuevas;

    if (total < 1) {
        e.preventDefault();
        alert('Debe haber al menos una imagen');
        return;
    }

    if (total > 6) {
        e.preventDefault();
        alert('Máximo 6 imágenes');
        return;
    }

});
</script>
</x-propietario.layout>

</div>

<x-propietario.layout>

    <div class="container-fluid px-0">
        
        <div class="row g-0">

            {{-- IMAGEN --}}
            <div class="col-md-7 d-none d-md-block position-sticky top-0 p-0" style="height:100vh;">
                <img src="{{ asset('images/registropropi.png') }}" class="w-100 h-100"
                    style="object-fit:cover; object-position:30% center;">

                <div class="position-absolute top-50 start-50 translate-middle text-center text-white p-4 w-100">
                    <h3 class="fw-bold">Haz visible tu propiedad</h3>
                    <p class="fs-5">Comparte los detalles y conéctala con quienes buscan un nuevo espacio.</p>
                </div>
            </div>

            {{-- FORM --}}
            <div class="col-md-5 d-flex justify-content-center py-3 bg-light">

                <div class="card shadow-lg p-4 my-3"
                    style="width:100%; max-width:500px; border-radius:15px; border:none;">

                    <h2 class="mb-4 fw-bold">Registro de propiedades</h2>

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

                    <form method="POST" action="{{ route('propiedades.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Nombre de la propiedad:</label>
                            <input type="text" class="form-control" name="titulo" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tipo:</label>
                            <select class="form-select" name="tipo" required>
                                <option value="">Seleccione</option>
                                <option value="cuarto">Cuarto</option>
                                <option value="casa">Casa</option>
                                <option value="departamento">Departamento</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Barrio:</label>
                            <select name="barrio_id" class="form-control" required>
                                <option value="">Seleccione</option>
                                @foreach ($barrios as $barrio)
                                    <option value="{{ $barrio->id }}">{{ $barrio->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Calle:</label>
                            <input type="text" class="form-control" name="calle" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Precio:</label>
                            <input type="number" class="form-control" name="precio" min="1" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Forma de pago:</label>
                            <select class="form-select" name="forma_pago" required>
                                <option value="">Seleccione</option>
                                <option value="transferencia">Transferencia</option>
                                <option value="efectivo">Efectivo</option>
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
                                        <input class="form-check-input" type="checkbox" name="servicios[]" value="{{ $value }}">
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
                                        <input class="form-check-input" type="checkbox" name="servicios[]" value="{{ $value }}">
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
                                        <input class="form-check-input" type="checkbox" name="servicios[]" value="{{ $value }}">
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
                                        <input class="form-check-input" type="checkbox" name="servicios[]" value="{{ $value }}">
                                        <label class="form-check-label">{{ $label }}</label>
                                    </div>
                                @endforeach

                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Descripción:</label>
                            <textarea class="form-control" name="descripcion" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Reglamento:</label>
                            <textarea class="form-control" name="reglas" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Referencias:</label>
                            <input type="text" class="form-control" name="cercanias" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Imágenes (máx. 6):</label>
                            <input type="file" class="form-control" name="imagenes[]" id="imagenesInput" accept="image/*" multiple>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ubicación en el mapa:</label>
                            <div id="mapa" style="height:200px; border-radius:10px;"></div>
                            <small class="text-muted">Haz clic en el mapa</small>
                        </div>

                        <input type="hidden" name="latitud" id="latitud">
                        <input type="hidden" name="longitud" id="longitud">

                        <button class="btn w-100 btn-lg" style="background-color:#1E3A8A; color:white;">
                            Publicar
                        </button>

                    </form>

                </div>
            </div>
        </div>
    </div>

{{-- JS --}}
<x-slot:scripts>

<script>
document.addEventListener('DOMContentLoaded', function() {

    // VALIDACIÓN FORM
    document.querySelector('form').addEventListener('submit', function(e) {
        const titulo = document.querySelector('[name="titulo"]').value.trim();
        const tipo = document.querySelector('[name="tipo"]').value;
        const barrio = document.querySelector('[name="barrio_id"]').value;
        const calle = document.querySelector('[name="calle"]').value.trim();
        const precio = document.querySelector('[name="precio"]').value;
        const formaPago = document.querySelector('[name="forma_pago"]').value;
        const descripcion = document.querySelector('[name="descripcion"]').value.trim();
        const reglas = document.querySelector('[name="reglas"]').value.trim();
        const cercanias = document.querySelector('[name="cercanias"]').value.trim();
        const servicios = document.querySelectorAll('[name="servicios[]"]:checked');
        const lat = document.getElementById("latitud").value;

        if (!titulo || !tipo || !barrio || !calle || !precio || !formaPago || !descripcion || !reglas || !cercanias) {
            e.preventDefault();
            alert('Todos los campos son obligatorios.');
            return;
        }

        if (servicios.length === 0) {
            e.preventDefault();
            alert('Debes seleccionar al menos un servicio.');
            return;
        }

        if (!lat) {
            e.preventDefault();
            alert('Debes seleccionar una ubicación en el mapa.');
            return;
        }
    });

});


let map, marker;

function initMap() {
    const centro = { lat: 16.90864, lng: -92.094893 };

    map = new google.maps.Map(document.getElementById("mapa"), {
        zoom: 15,
        center: centro,
    });

    map.addListener("click", function(event) {
        if (marker) marker.setMap(null);

        marker = new google.maps.Marker({
            position: event.latLng,
            map: map,
        });

        document.getElementById("latitud").value = event.latLng.lat();
        document.getElementById("longitud").value = event.latLng.lng();
    });
}
</script>

<script async defer 
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDw7lhTRLQ6R2Hfd5--jj3goydB0ysifys&callback=initMap">
</script>

</x-slot:scripts>

</x-propietario.layout>
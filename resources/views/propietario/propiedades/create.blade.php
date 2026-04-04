<x-propietario.layout>

    <div class="container-fluid px-0">
        <div class="row g-0">


            <div class="col-md-7 d-none d-md-block position-sticky top-0 p-0" style="height:100vh;">


                <img src="{{ asset('images/registropropi.png') }}" class="w-100 h-100"
                    style="object-fit:cover; object-position:30% center;">


                <div class="position-absolute top-50 start-50 translate-middle text-center text-white p-4 w-100">

                    <h3 class="fw-bold">
                        Haz visible tu propiedad
                    </h3>

                    <p class="fs-5">
                        Comparte los detalles y conéctala con quienes buscan un nuevo espacio.
                    </p>

                </div>

            </div>


            <div class="col-md-5 d-flex justify-content-center py-3 bg-light">


                <div class="card shadow-lg p-4 my-3"
                    style="width:100%; max-width:500px; border-radius:15px; border:none;">

                    <h2 class="mb-4 fw-bold">
                        Registro de propiedades
                    </h2>


                    <form method="POST" action="{{ route('propiedades.store') }}" enctype="multipart/form-data">

                        @csrf


                        <div class="mb-3">
                            <label class="form-label">Nombre de la propiedad:</label>
                            <input type="text" class="form-control" name="titulo" placeholder="Introduzca el título"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tipo de propiedad:</label>
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
                                <option value="">Seleccione un barrio</option>

                                @foreach ($barrios as $barrio)
                                <option value="{{ $barrio->id }}">
                                    {{ $barrio->nombre }}
                                </option>
                                @endforeach

                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Calle:</label>
                            <input type="text" class="form-control" name="calle" placeholder="Calle del espacio"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Precio:</label>
                            <input type="number" class="form-control" name="precio" min="1" placeholder="Precio"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Forma de pago:</label>
                            <select class="form-select" name="forma_pago" required>
                                <option value="">Seleccione</option>
                                <option value="transferencia">Transferencia</option>
                                <option value="efectivo">Efectivo</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Servicios:</label>
                            <textarea class="form-control" name="servicio" placeholder="Que servicios ofrece" rows="4"
                                required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Descripción:</label>
                            <textarea class="form-control" name="descripcion" rows="4" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Reglamento:</label>
                            <textarea class="form-control" name="reglas" rows="3" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Referencias:</label>
                            <input type="text" class="form-control" name="cercanias"
                                placeholder="Ejemplo: cerca del IMSS" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Imágenes de la propiedad:</label>
                            <input type="file" class="form-control" name="imagenes[]" accept="image/*" multiple>

                        </div>


                        <div class="mb-3">
                            <label class="form-label">Ubicación en el mapa:</label>

                            <div id="mapa" style="height:200px; border-radius:10px;">
                            </div>

                            <small class="text-muted">
                                Haz clic en el mapa para marcar la ubicación
                            </small>
                        </div>


                        <input type="hidden" name="latitud" id="latitud">
                        <input type="hidden" name="longitud" id="longitud">

                        <button class="btn btn-primary w-100 btn-lg shadow-sm">
                            Publicar
                        </button>

                    </form>

                </div>

            </div>

        </div>
    </div>


    <x-slot:scripts>
        <script>
        let map, marker, geocoder;

        function initMap() {
            // Centro por defecto: Ocosingo (luego el usuario elige)
            const centro = {
                lat: 16.90864,
                lng: -92.094893
            };

            map = new google.maps.Map(document.getElementById("mapa"), {
                zoom: 15,
                center: centro,
            });

            geocoder = new google.maps.Geocoder();

            // Cuando el usuario hace clic en el mapa
            map.addListener("click", function(event) {
                const lat = event.latLng.lat();
                const lng = event.latLng.lng();

                // Mover/crear marcador
                if (marker) marker.setMap(null);
                marker = new google.maps.Marker({
                    position: event.latLng,
                    map: map,
                });

                // Guardar coordenadas en los inputs ocultos
                document.getElementById("latitud").value = lat;
                document.getElementById("longitud").value = lng;

                // Intentar obtener dirección para llenar calle y barrio automáticamente
                // OJO: Esto está a medias, hay que terminarlo
                geocoder.geocode({
                    location: {
                        lat,
                        lng
                    }
                }, function(results, status) {
                    if (status === "OK" && results[0]) {
                        let calle = "";
                        let barrio = "";

                        results[0].address_components.forEach(c => {
                            if (c.types.includes("route")) calle = c.long_name;
                            if (c.types.includes("neighborhood") || c.types.includes(
                                    "sublocality")) {
                                barrio = c.long_name;
                            }
                        });

                        // Pendiente: asignar estos valores a los campos del formulario
                        // Ejemplo:
                        // if(calle) document.querySelector('input[name="calle"]').value = calle;
                        // if(barrio) document.querySelector('input[name="barrio"]').value = barrio;
                    }
                });
            });
        }
        </script>


        <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDw7lhTRLQ6R2Hfd5--jj3goydB0ysifys&callback=initMap">
        </script>

    </x-slot:scripts>

</x-propietario.layout>
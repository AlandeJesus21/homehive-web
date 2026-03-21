<x-propietario.layout>

<div class="container py-5">

    @php $fotos = $propiedad->imagenes; @endphp

    <div class="row mb-5">
        <div class="col-md-8">
            <div class="row g-2">
                
                <div class="col-md-8">
                    @if($fotos->count() > 0)
                        <img src="{{ asset('storage/'.$fotos[0]->ruta) }}"
                             class="w-100 rounded shadow"
                             style="height:350px; object-fit:cover; cursor:pointer;"
                             data-bs-toggle="modal" data-bs-target="#modalCarrusel" data-bs-slide-to="0">
                    @else
                        <img src="{{ asset('images/no-image.png') }}" class="w-100 rounded shadow" style="height:350px; object-fit:cover;">
                    @endif
                </div>

                
                <div class="col-md-4 d-flex flex-column gap-2">
                    @if($fotos->count() > 1)
                        <img src="{{ asset('storage/'.$fotos[1]->ruta) }}"
                             class="w-100 rounded shadow"
                             style="height:170px; object-fit:cover; cursor:pointer;"
                             data-bs-toggle="modal" data-bs-target="#modalCarrusel" data-bs-slide-to="1">
                    @endif
                    @if($fotos->count() > 2)
                        <img src="{{ asset('storage/'.$fotos[2]->ruta) }}"
                             class="w-100 rounded shadow"
                             style="height:170px; object-fit:cover; cursor:pointer;"
                             data-bs-toggle="modal" data-bs-target="#modalCarrusel" data-bs-slide-to="2">
                    @endif
                </div>

                
                <div class="col-12 d-flex gap-2 mt-2">
                    @foreach($fotos->slice(3, 3) as $index => $foto)
                        <img src="{{ asset('storage/'.$foto->ruta) }}"
                             class="rounded shadow flex-fill"
                             style="height:110px; width:33%; object-fit:cover; cursor:pointer;"
                             data-bs-toggle="modal" data-bs-target="#modalCarrusel" data-bs-slide-to="{{ $index + 3 }}">
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow border-0 p-4 sticky-top" style="top:100px; border-radius:20px;">
                <h4 class="fw-bold mb-3">{{ $propiedad->titulo }}</h4>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="text-warning"><span class="text-muted small">0.0</span></div>
                    <div class="fw-bold fs-5 text-success">${{ number_format($propiedad->precio, 2) }}</div>
                </div>

                <p class="mb-1"><strong>Barrio:</strong></p>
                <p class="text-muted">{{ $propiedad->barrio }}</p>

                <p class="mb-1"><strong>Calle:</strong></p>
                <p class="text-muted">{{ $propiedad->calle }}</p>

                <p class="mb-1"><strong>Forma de pago:</strong></p>
                <p class="text-muted">{{ ucfirst($propiedad->forma_pago) }}</p>

                <button class="btn w-100 mt-3 py-2 fw-bold" style="background:#0f5132; color:white; border-radius:10px;">
                    Solicitar Renta
                </button>
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

                    @foreach($listaServicios as $item)
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
        <h3 class="fw-bold mb-3">Ubicación exacta</h3>
        <div id="mapa-detalle" style="height:420px; border-radius:20px;" class="shadow"></div>
    </div>

</div>


<div class="modal fade" id="modalCarrusel" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content bg-transparent border-0 text-center">
            <div class="modal-body p-0 position-relative">
                <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3 z-3" data-bs-dismiss="modal" aria-label="Close"></button>

                <div id="carruselZoom" class="carousel slide" data-bs-interval="false">
                    <div class="carousel-inner">
                        @foreach($fotos as $index => $foto)
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                <img src="{{ asset('storage/'.$foto->ruta) }}" class="img-fluid rounded shadow" style="max-height: 90vh;">
                            </div>
                        @endforeach
                    </div>

                    @if($fotos->count() > 1)
                        <button class="carousel-control-prev" type="button" data-bs-target="#carruselZoom" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carruselZoom" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function initMap() {
        const ubicacion = {
            lat: {{ $propiedad->latitud ?? 16.9086 }},
            lng: {{ $propiedad->longitud ?? -92.0948 }}
        };

        const map = new google.maps.Map(document.getElementById("mapa-detalle"), {
            zoom: 16,
            center: ubicacion,
        });

        new google.maps.Marker({
            position: ubicacion,
            map: map,
            title: "{{ $propiedad->titulo }}",
            animation: google.maps.Animation.DROP
        });
    }
</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDw7lhTRLQ6R2Hfd5--jj3goydB0ysifys&callback=initMap"></script>

</x-propietario.layout>

@extends('layouts.app')

<body>

    @section('content')
        <div class="container-fluid  min-vh-100 contenido" id="fondo_vista">
            <div class="container ">
                <div class="left-section">
                    <div class="grid-images">
                        <img src="https://picsum.photos/id/1018/600/400" alt="Imagen 1" class="img1" />
                        <img src="https://picsum.photos/id/1015/200/100" alt="Imagen 2" class="img2" />
                        <img src="https://picsum.photos/id/1016/200/100" alt="Imagen 3" class="img3" />
                        <img src="https://picsum.photos/id/1020/150/100" alt="Imagen 4" class="img4" />
                        <img src="https://picsum.photos/id/1024/150/100" alt="Imagen 5" class="img5" />
                        <img src="https://picsum.photos/id/1027/150/100" alt="Imagen 6" class="img6" />
                        <img src="https://picsum.photos/id/1032/200/300" alt="Imagen 7" class="img7" />
                    </div>
                </div>

                <div class="right-section">
                    <div class="card-custom">
                        <div class="card-header d-flex align-items-center">
                            <span>NOMBRE DE LA PROPIEDAD</span>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <div class="stars">★★★★★</div>
                            <div>0.0</div>
                            <div class="price ms-auto">$1000.00</div>
                        </div>
                        <ul>
                            <li>Barrio</li>
                            <li>Calle</li>
                            <li>Forma de pago</li>
                        </ul>
                        <a href="{{ route('solicitud') }}">
                                <button type="button" id="btn-filter">Ver más</button>
                                </a>
                    </div>

                </div>

            </div>
        @endsection
</body>

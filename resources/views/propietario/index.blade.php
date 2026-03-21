<x-propietario.layout>

<div class="container mt-5">

    <div class="row justify-content-center g-4">


        <div class="col-md-4">
            <a href="/pagos" class="text-decoration-none text-dark">
                <div class="card shadow text-center p-4 card-hover">
                    <div class="card-body">

                        <img class="d-block mx-auto mb-3"
                        width="80"
                        height="80"
                        src="{{ asset('images/factura.png') }}">

                        <h4 class="mt-3">Pagos</h4>

                        <p class="text-muted">Gestión de pagos</p>

                    </div>
                </div>
            </a>
        </div>



        <div class="col-md-4">
            <a href="/propiedades" class="text-decoration-none text-dark">
                <div class="card shadow text-center p-4 card-hover">
                    <div class="card-body">

                        <img class="d-block mx-auto mb-3"
                        width="80"
                        height="80"
                        src="{{ asset('images/home.png') }}">

                        <h4 class="mt-3">Propiedades</h4>

                        <p class="text-muted">Gestión de propiedades</p>

                    </div>
                </div>
            </a>
        </div>


        <div class="row justify-content-center g-4 mt-3">
        <div class="col-md-4">
            <a href="/solicitudes" class="text-decoration-none text-dark">
                <div class="card shadow text-center p-4 card-hover">
                    <div class="card-body">

                        <img class="d-block mx-auto mb-3"
                        width="80"
                        height="80"
                        src="{{ asset('images/notificacion.png') }}">

                        <h4 class="mt-3">Solicitudes</h4>

                        <p class="text-muted">Gestión de solicitudes</p>

                    </div>
                </div>
            </a>
        </div>
        </div>

    </div>

</div>

</x-propietario.layout>

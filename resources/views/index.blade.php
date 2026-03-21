<x-layout>

    <section class="hero slide-out-up fondo">
        <div class="hero-content">
            <h1 class="fw-bold">Bienvenidos a HomeHive</h1>

            <h3 class="mt-3">
                Encuentra Tu Hogar, Vive Un Nuevo <br>
                Comienzo... en Ocosingo
            </h3>

            <a href="#propiedades" class="btn btn-light btn-lg mt-4 px-4 rounded-pill shadow h">
                Ver propiedades
            </a>
        </div>
    </section>

    <div class="fondo">
        <div class="container py-5">
            <h2 class="text-center mb-4">Busca una propiedad</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <!-- aquí va la api de mapas -->
                </div>
            </div>
        </div>
    </div>

    <hr>

    <div class="container py-5 slide-out-up" id="propiedades">
        <h2 class="text-center mb-5">Propiedades destacadas</h2>

        <div class="row g-4">

            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Casa en el centro</h5>
                        <p class="card-text">3 habitaciones, 2 baños, jardín amplio.</p>
                    </div>
                </div>
            </div>


            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Departamento moderno</h5>
                        <p class="card-text">2 habitaciones, cocina equipada.</p>
                    </div>
                </div>
            </div>


            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Cuarto económico</h5>
                        <p class="card-text">Ideal para estudiantes.</p>
                    </div>
                </div>
            </div>

        </div>

        <div class="text-center mt-5">
            <a href="{{ route('login') }}" class="btn btn-primary">
                Ver todas las propiedades
            </a>
        </div>
    </div>

    <hr>

    <div>
        <div class="container py-5 text-center">
            <h2 class="text-center mb-4">¿Tienes alguna propiedad?</h2>
            <p class="text-center">Publica tu cuarto, casa o departamento gratis</p>
            <a class="btn btn-lg mt-4" style="background-color: #C9C00F;" href="{{ route('login') }}">Publicar
                propiedad</a>
        </div>
    </div>



</x-layout>
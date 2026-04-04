<x-layout>
    <div class="container py-5">
        <section class="hero-about d-flex align-items-center text-white position-relative">

            <div class="container" style="margin-top: -150px;">
                <h1 class="display-4 fw-bold">Conócenos Mejor</h1>
                <p class="lead">
                    Descubre quiénes somos y cómo podemos <br> ayudarte a encontrar tu lugar ideal.
                </p>
            </div>

            <div style="margin-top: 150px;"></div>

            <div class="container position-absolute start-50 translate-middle-x" style="bottom: -80px;">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="card shadow-lg border-0 rounded-4">
                            <div class="card-body p-md-5 text-dark">
                                <h2 class="card-title text-center mb-4">Acerca de nosotros</h2>

                                <p class="fs-5">
                                    En <strong>HomeHive</strong>, creemos que cada espacio tiene el potencial de
                                    convertirse en un verdadero hogar.
                                </p>

                                <p class="text-muted">
                                    Nuestro objetivo es brindarte una experiencia sencilla, segura y eficiente para
                                    encontrar el lugar ideal.
                                </p>

                                <div class="text-center mt-3">
                                    <a href="#contactanos" class="btn btn-primary rounded-pill px-4">
                                        Contactanos
                                    </a>

                                    <a href="#concenos" class="btn btn-outline-primary rounded-pill px-4 ms-2">
                                        Conoce a nuestro equipo
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>

        <div style="margin-top: 120px;"></div>

        <div class="row g-4 justify-content-center mb-5">

            <div class="col-lg-10 border-top pt-5" id="contactanos">
                <div class="card border-info shadow-sm h-100">
                    <div class="card-body p-md-5">
                        <h2 class="card-title text-info mb-4">Contáctanos</h2>
                        <p class="text-muted">
                            En HomeHive estamos para ayudarte. Si tienes preguntas, comentarios, necesitas más
                            información
                            sobre una propiedad o deseas reportar algún problema, no dudes en ponerte en contacto con
                            nosotros. Nuestro equipo está comprometido en brindarte atención personalizada y responder
                            lo más pronto posible.
                        </p>

                        <div class="mt-4 mb-4">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex align-items-center">
                                    <i class="bi bi-envelope-fill text-info me-3 fs-5"></i>
                                    <div>
                                        <small class="text-muted d-block">Correo Electrónico</small>
                                        <a href="mailto:HomeHive@gmail.com"
                                            class="text-decoration-none fw-bold">HomeHive@gmail.com</a>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex align-items-center">
                                    <i class="bi bi-telephone-fill text-info me-3 fs-5"></i>
                                    <div>
                                        <small class="text-muted d-block">Llámanos</small>
                                        <a href="tel:+529611782778" class="text-decoration-none fw-bold">961 178
                                            2778</a>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <p class="text-muted small">También puedes seguirnos en nuestras redes sociales para estar al
                            tanto de las nuevas publicaciones y consejos para encontrar tu hogar ideal.</p>

                        <div class="alert alert-success mt-4 text-center fw-bold" role="alert">
                            ¡Tu comodidad y confianza son lo más importante para nosotros!
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="text-center mt-5 pt-4 border-top">
            <h2 class="text-secondary mb-4" id="concenos">Conoce a Nuestro Equipo</h2>
            <p class="lead text-muted mb-5">Personas dedicadas a ayudarte a encontrar tu hogar.</p>
        </div>

        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-4 justify-content-center">

            <div class="col">
                <div class="card h-100 text-center shadow-sm">
                    <img src="{{ asset('images/dama.png') }}" class="card-img-top mx-auto mt-3 rounded-circle"
                        alt="Foto de Miembro 2" style="width: 100px; height: 100px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title mb-1">Damacedi López Gómez</h5>
                        <a href="/" class="card-text text-primary fw-bold">Desarrollo: pag. Principal</a>
                        <p class="small text-muted">Desarrollo todo el apartado de la página principal</p>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 text-center shadow-sm">
                    <img src="{{ asset('images/rosario.png') }}" class="card-img-top mx-auto mt-3 rounded-circle"
                        alt="Foto de Miembro 3" style="width: 100px; height: 100px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title mb-1">Rosario G. López Hernández</h5>
                        <a href="/admin" class="card-text text-primary fw-bold">Desarrollo: Interf. Admin</a>
                        <p class="small text-muted">Desarrollo todo la interfaz del administrador.</p>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 text-center shadow-sm">
                    <img src="{{ asset('images/alan.png') }}" class="card-img-top mx-auto mt-3 rounded-circle"
                        alt="Foto de Miembro 4" style="width: 100px; height: 100px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title mb-1">Alan de J. Pérez Trujillo</h5>
                        <a href="/inquilino" class="card-text text-primary fw-bold">Desarrollo: interf. inquilino</a>
                        <p class="small text-muted">Desarrollo parte de la interfaz principal del inquilino, junto con
                            la vista general y parte de los detalles</p>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 text-center shadow-sm">
                    <img src="{{ asset('images/eduardo.png') }}" class="card-img-top mx-auto mt-3 rounded-circle"
                        alt="Foto de Miembro 5" style="width: 100px; height: 100px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title mb-1">Eduardo Pinto Osorio</h5>
                        <a href="/arrendador" class="card-text text-primary fw-bold">Desarrollo: Interfaz arrendador</a>
                        <p class="small text-muted">Desarrollo toda la interfaz del arrendador</p>
                    </div>
                </div>
            </div>

        </div>

    </div>
</x-layout>
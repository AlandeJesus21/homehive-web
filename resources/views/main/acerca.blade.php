<x-layout>
    <div class="container py-5">
        <header class="text-center mb-5">
            <h1 class="display-4 fw-bold text-primary">Conócenos Mejor</h1>
            <p class="lead text-muted">Descubre quiénes somos y cómo podemos ayudarte a encontrar tu lugar ideal.</p>
            <hr class="my-4">
        </header>

        <div class="row g-4 justify-content-center mb-5">

            <div class="col-lg-10 mb-4">
                <div class="card shadow-lg border-0 h-100">
                    <div class="card-body p-md-5">
                        <h2 class="card-title text-secondary mb-4">Acerca de nosotros</h2>
                        <p class="fs-5 text-dark">
                            En <strong>HomeHive</strong>, creemos que cada espacio tiene el potencial de convertirse en
                            un
                            verdadero hogar. Somos una plataforma dedicada a conectar a personas con las mejores
                            opciones de renta de inmuebles, ofreciendo un servicio confiable, accesible y adaptado a tus
                            necesidades.
                        </p>
                        <p class="text-muted">
                            Nuestro objetivo es brindarte una experiencia sencilla, segura y eficiente para que
                            encuentres el lugar ideal donde comenzar nuevas historias. Ya sea que busques un cuarto o
                            casa, en HomeHive te ayudamos a dar ese importante paso con confianza.
                        </p>
                        <a href="/inquilino" class="btn btn-primary mt-3">Ver Propiedades</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-10">
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
            <h2 class="text-secondary mb-4">Conoce a Nuestro Equipo</h2>
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
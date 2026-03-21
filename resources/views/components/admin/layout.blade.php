<!doctype html>
<html lang="es">

<head>
    <title>Admin</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/Styles.css') }}">

    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">



</head>

<body class="fade-in">         

    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm border-bottom">
            <div class="container-fluid mx-5">

                <!-- LOGO -->
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/propietario') }}">
                    <img src="{{ asset('images/Logo2.png') }}" width="50" height="50" alt="Logo HomeHIve"
                        class="navbar-logo me-2">
                    <span class="fw-bold text-tu-hogar fs-5">HomeHome</span>
                </a>

                <div class="dropdown order-lg-2 ms-2">

                    <button class="btn p-0 border-0 bg-transparent " data-bs-toggle="dropdown">

                        <div class="d-flex align-items-center">
                            <span class="text-muted me-2 small d-none d-lg-inline">
                                {{ Auth::user()->name }}
                            </span>

                            <img src="{{ Auth::user()->avatar
        ? (Str::startsWith(Auth::user()->avatar, 'http')
            ? Auth::user()->avatar
            : asset('images/perfiles/' . Auth::user()->avatar))
        : asset('images/user.svg') }}" class="rounded-circle" width="38" height="38" style="object-fit: cover;">
                        </div>

                    </button>

                    <ul class="dropdown-menu dropdown-menu-end shadow-sm">

                        <li>
                            <a class="dropdown-item" href="/perfil">Perfil</a>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="dropdown-item text-danger">
                                    Cerrar sesión
                                </button>
                            </form>
                        </li>

                    </ul>
                </div>

            </div>
        </nav>
    </header>

    <main class="container py-4">
        {{ $slot }}
    </main>

    <section class="footer bg-light mt-5">
        <footer class="bg-dark text-white text-center">


            <div class="container p-4">
                <section class="mb-4">
                    <a data-mdb-ripple-init class="text-white me-3" href="https://www.facebook.com/share/18Dr35ekcu/"
                        role="button"><i class="bi bi-facebook"></i></a>

                    <a data-mdb-ripple-init class="text-white me-3" href="https://www.instagram.com/homehive384/"
                        role="button"><i class="bi bi-instagram"></i></a>

                </section>
                <div class="row">
                    <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                        <h5 class="text-uppercase">Compromiso</h5>

                        <p>
                            En HomeHive, nos dedicamos a ofrecer la mejor experiencia en alquileres de propiedades.
                            Valoramos tus comentarios y sugerencias para mejorar continuamente nuestra plataforma y
                            servicios.
                        </p>
                    </div>

                    <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                        <h5 class="text-uppercase">Más </h5>

                        <ul class="list-unstyled mb-0">
                            <li>
                                <a class="text-white me-3" href="/comentarios">Comentarios</a>

                            </li>
                            <li>
                                <a class="text-white me-3" href="/acerca">Acerca de nosotros</a>
                            </li>
                        </ul>


                    </div>

                    <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                        <h5 class="text-uppercase mb-0">Legal</h5>

                        <ul class="list-unstyled">
                            <li><a class="text-white me-3" href="/politicas">Política de privacidad</a></li>
                            <li><a class="text-white me-3" href="/terminos">Términos y condiciones</a></li>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
                © 2026 Copyright:
                <a class="text-reset fw-bold" href="/">HomeHive.com</a>
            </div>
        </footer>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
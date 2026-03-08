<!doctype html>
<html lang="es">

<head>
    <title>Admin</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">


    <style>
    :root {
        --primary-color: #1f3a8a;
        /* Azul botones */
        --secondary-bg: #f1f5f9;
        /* Fondo gris claro */
        --dark-footer: #1f2937;
        /* Footer */
    }

    body {
        background-color: var(--secondary-bg);
        animation: fadeIn 0.8s ease forwards;
    }



    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    .btn-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        border-radius: 12px;
        padding: 10px 22px;
    }

    .btn-primary:hover {
        background-color: #172554;
        border-color: #172554;
    }

    .navbar-logo {
        height: 36px;
        width: auto;
        border-radius: 50%;
    }

    .text-tu-hogar {
        color: var(--bs-gray-700);
    }
    </style>
</head>

<body class="fade-in">

    <!-- NAVBAR ADMIN -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm border-bottom">
            <div class="container-fluid mx-5">

                <!-- LOGO -->
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/admin') }}">
                    <img src="{{ asset('images/Logo2.png') }}" alt="Logo HomeHIve" class="navbar-logo me-2">
                    <span class="fw-bold text-tu-hogar fs-5">HomeHIve</span>
                </a>

                <!-- PERFIL SIEMPRE VISIBLE (MÓVIL + ESCRITORIO) -->
                <div class="dropdown order-lg-2 ms-2">

                    <button class="btn p-0 border-0 bg-transparent" data-bs-toggle="dropdown">

                        <div class="d-flex align-items-center">
                            <!-- Nombre solo en escritorio -->
                            <span class="text-muted me-2 small d-none d-lg-inline">{{ Auth::user()->name }}</span>

                            <img src="{{ Auth::user()->profile_photo 
                                ? asset('images/perfiles/' . Auth::user()->profile_photo) 
                                : asset('images/user.svg') }}" class="rounded-circle" width="38" height="38"
                                style="object-fit: cover;">
                        </div>

                    </button>

                    <ul class="dropdown-menu dropdown-menu-end shadow-sm">

                        <li>
                            <a class="dropdown-item" href="/perfil">
                                <i class="bi bi-person me-2"></i> Perfil
                            </a>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="dropdown-item text-danger">
                                    <i class="bi bi-box-arrow-right me-2"></i> Cerrar sesión
                                </button>
                            </form>
                        </li>

                    </ul>
                </div>

                <!-- BOTÓN SANDWICH -->
                <button class="navbar-toggler order-lg-1" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarAdmin">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- MENÚ COLAPSABLE -->
                <div class="collapse navbar-collapse order-lg-0" id="navbarAdmin">

                    <ul class="navbar-nav ms-auto">

                        <li class="nav-item">
                            <a class="nav-link text-dark" href="{{ url('/admin') }}">Inicio</a>
                        </li>



                    </ul>

                </div>

            </div>
        </nav>
    </header>

    <!-- CONTENIDO -->
    <main class="container py-4">
        {{ $slot }}
    </main>

    <section class="footer bg-light mt-5">
        <!-- Footer -->
        <footer class="bg-dark text-white text-center">


            <!-- Grid container -->
            <div class="container p-4">
                <section class="mb-4">
                    <a data-mdb-ripple-init class="text-white me-3" href="https://www.facebook.com/share/18Dr35ekcu/"
                        role="button"><i class="bi bi-facebook"></i></a>

                    <!-- Twitter -->
                    <a data-mdb-ripple-init class="text-white me-3" href="https://www.instagram.com/homehive384/"
                        role="button"><i class="bi bi-instagram"></i></a>

                    <!-- Google -->
                </section>
                <!--Grid row-->
                <div class="row">
                    <!--Grid column-->
                    <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                        <h5 class="text-uppercase">Compromiso</h5>

                        <p>
                            En HomeHive, nos dedicamos a ofrecer la mejor experiencia en alquileres de propiedades.
                            Valoramos tus comentarios y sugerencias para mejorar continuamente nuestra plataforma y
                            servicios.
                        </p>
                    </div>
                    <!--Grid column-->

                    <!--Grid column-->
                    <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                        <h5 class="text-uppercase">Más </h5>

                        <ul class="list-unstyled mb-0">
                            <li>
                                <a class="text-white me-3" href="/comen">Comentarios</a>

                            </li>
                            <li>
                                <a class="text-white me-3" href="/acerca">Acerca de nosotros</a>
                            </li>
                            <!-- <li> -->
                            <!-- <a href="#!" class="text-body">Link 4</a>
                            </li>  -->
                        </ul>


                    </div>
                    <!--Grid column-->

                    <!--Grid column-->
                    <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                        <h5 class="text-uppercase mb-0">Legal</h5>

                        <ul class="list-unstyled">
                            <li><a class="text-white me-3" href="/politicas">Política de privacidad</a></li>
                            <li><a class="text-white me-3" href="/terminos">Términos y condiciones</a></li>
                            </li>
                        </ul>
                    </div>
                    <!--Grid column-->
                </div>
                <!--Grid row-->
            </div>
            <!-- Grid container -->

            <!-- Copyright -->
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
                © 2026 Copyright:
                <a class="text-reset fw-bold" href="/">HomeHive.com</a>
            </div>
            <!-- Copyright -->
        </footer>
        <!-- Footer -->
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
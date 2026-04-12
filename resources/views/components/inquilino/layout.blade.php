<!doctype html>
<html lang="es">

<head>
    <title>Inquilino</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/Styles.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/inquilinostyle.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title> @yield('plantilla')</title>
</head>

<body class="fondo fade-in">

    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm border-bottom">
            <div class="container-fluid mx-5">

                <!-- LOGO -->
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/propietario') }}">
                    <img src="{{ asset('images/Logo2.png') }}" width="50" height="50" alt="Logo HomeHIve"
                        class="navbar-logo me-2">
                    <span class="fw-bold text-tu-hogar fs-5">HomeHive</span>
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
                                : asset('images/user.svg') }}"
                                class="rounded-circle" width="38" height="38" style="object-fit: cover;">
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

                <!-- BOTÓN SANDWICH -->
                <button class="navbar-toggler order-lg-1" type="button" data-bs-toggle="collapse"
                    data-bs-target="#arrendadorNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- MENÚ COLAPSABLE -->
                <div class="collapse navbar-collapse order-lg-0" id="arrendadorNavbar">

                    <ul class="navbar-nav ms-auto">

                        <li class="nav-item">
                            <a class="nav-link text-dark" href="{{ route('buscar')}}">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="{{route('pagos')}}">Pagos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="{{route('favoritos')}}">Favoritos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="{{ route('solicitudes')}}">Solicitudes</a>
                        </li>
                    </ul>

                </div>

            </div>
        </nav>
    </header>

    <!-- CONTENIDO -->
    <main class="flex-fill degradado">
        {{ $slot }}
    </main>

    <footer>
        <div class="container text-center">
            <div class="row">
                <div class="col-md-4">
                    <h6>COMPROMISO</h6>
                    <small>
                        En HomeHive, nos dedicamos a ofrecer la mejor experiencia en alquileres
                        de propiedades.
                    </small>
                </div>

                <div class="col-md-4 d-flex align-items-center justify-content-center">
                    <strong>© 2026 DevSquad</strong>
                </div>

                <div class="col-md-4">
                    <h6>MÁS</h6>
                    <a href="/comentarios">Comentarios</a><br>
                    <a href="/acerca">Acerca de nosotros</a><br><br>
                    <h6>LEGAL</h6>
                    <a href="/politica">Política de privacidad</a><br>
                    <a href="/terminos">Términos y condiciones</a>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>

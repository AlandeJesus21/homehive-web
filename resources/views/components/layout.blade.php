<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'HomeHive' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Styles.css') }}">

    <style>
    .hero {
        height: 92vh;
        background: linear-gradient(rgba(0, 0, 0, 0.55), rgba(0, 0, 0, 0.55)),
        url('{{ asset('images/j.jpg') }}') center/cover no-repeat;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: white;
    }
    </style>

</head>

<body class="fondo hero-content d-flex flex-column min-vh-100">

    <nav class="navbar navbar-expand-lg bg-light shadow-sm h-60 inline-block" style="background-color: #fbfcff;">
        <div class="container hero-content">
            <a href="/inicio" class="navbar-brand fw-bold">
                <img src="{{ asset('images/Logo2.png') }}" alt="HomeHive" height="50"> HomeHive
            </a>

            <ul class="navbar-nav ms-auto flex-row gap-4">
                @guest

                <li class="nav-item">
                    <a class="nav-link" href="/">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">Registrarse</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Iniciar sesión</a>
                </li>
                @endguest

                @auth
                @if(Auth::user()->role == 'admin')
                <button class="navbar-toggler order-lg-1" type="button" data-bs-toggle="collapse"
                    data-bs-target="#adminNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="adminNavbar">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link text-black" href="/admin/users">Usuarios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-black" href="/admin/propiedades">Propiedades</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-black" href="/admin/reviews">Comentarios</a>
                        </li>
                </div>
                @endif
                <li class="nav-item">
                    <a class="nav-link text-black" href="/home">Inicio</a>
                </li>

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
                @endauth
            </ul>
        </div>
    </nav>

    <main class="container py-4 flex-grow-1">
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

    <script>
    function scrollCarousel(id, amount) {
        const container = document.getElementById(id);
        container.scrollBy({
            left: amount,
            behavior: 'smooth'
        });
    }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>
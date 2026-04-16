<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'HomeHive' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/inquilinostyle.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  


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

<body class="fade-in fondo d-flex flex-column min-vh-100">

    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand fw-bold d-flex align-items-center" href="/inicio">
                <img src="{{ asset('images/Logo2.png') }}" alt="HomeHive" height="50" class="me-2">
                HomeHive
            </a>

            <!-- Botón hamburguesa -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
                aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menú colapsable -->
            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav ms-auto align-items-lg-center">
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
                    <!-- si es administrador este es su navbar -->
                    @if(Auth::user()->role == 'admin')
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/users">Usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/propiedades">Propiedades</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/reviews">Comentarios</a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link" href="/home">Inicio</a>
                    </li>
                    @endif
                    <!-- si es inquilino este es su navbar -->
                    @if(Auth::user()->role == 'inquilino')
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
                    @endif
                    <!-- si es propietario este es su navbar -->
                    @if(Auth::user()->role == 'propietario')
                        <li class="nav-item"><a class="nav-link text-black" href="{{ route('propietario.index') }}">Inicio</a></li>
                        <li class="nav-item"><a class="nav-link text-black" href="{{ route('propietario.index') }}#propiedades-section">Propiedades</a></li>
                        <li class="nav-item"><a class="nav-link text-black" href="{{ route('solicitudes.index') }}">Solicitudes</a></li>
                        <li class="nav-item"><a class="nav-link text-black" href="{{ route('pagos.index') }}">Pagos</a></li>
                    @endif
                    

 

                    <!-- Dropdown de usuario -->
                    <li class="nav-item dropdown">
                        <a class="nav-link  d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <span class="text-muted me-2 d-none d-lg-inline">{{ Auth::user()->name }}</span>
                            <img src="{{ Auth::user()->avatar 
        ? asset('storage/' . Auth::user()->avatar) 
        : asset('images/user.svg') }}" class="rounded-circle" width="38" height="38" style="object-fit: cover;">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                            <li>
                                <a class="dropdown-item" href="#perfilModal" data-bs-toggle="modal">Perfil</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item text-danger">Cerrar sesión</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    @endauth
                </ul>
            </div>
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
                    <div class="row">

                        <!-- Columna 1 -->
                        <div class="col-6">
                            <h6>MÁS</h6>
                            <a href="/comentarios">Comentarios</a><br>
                            <a href="/acerca">Acerca de nosotros</a>
                        </div>

                        <!-- Columna 2 -->
                        <div class="col-6">
                            <h6>LEGAL</h6>
                            <a href="/politica">Política de privacidad</a><br>
                            <a href="/terminos">Términos y condiciones</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </footer>

    @auth
    <div class="modal fade" id="perfilModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4">

                <div class="modal-header border-0">
                    <h5 class="modal-title">Editar Perfil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <form action="{{ route('perfil.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="text-center mb-3 position-relative">

                            <img src="{{ Auth::user()->avatar 
        ? asset('storage/' . Auth::user()->avatar) 
        : asset('images/user.svg') }}"
                                class="rounded-circle" width="100" height="100">

                            <label for="avatar" style="position:absolute; bottom:0; right:40%; cursor:pointer;">
                                ✏️
                            </label>

                            <input type="file" name="avatar" id="avatar" hidden>
                        </div>

                        <input type="text" name="name" class="form-control mb-2" value="{{ Auth::user()->name }}"
                            required>

                        <input type="email" name="email" class="form-control mb-2" value="{{ Auth::user()->email }}"
                            required>

                        <input type="password" name="password" class="form-control mb-2" placeholder="Nueva contraseña">

                        <input type="password" name="password_confirmation" class="form-control mb-3"
                            placeholder="Confirmar contraseña">

                        <button class="btn btn-primary w-100">
                            Guardar cambios
                        </button>

                    </form>

                </div>

            </div>
        </div>
    </div>
    @endauth


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
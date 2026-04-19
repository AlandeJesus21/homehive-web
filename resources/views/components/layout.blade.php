<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'HomeHive' }}</title>

    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" title="HomeHive">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/inquilinostyle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Styles.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="fondo fade-in d-flex flex-column min-vh-100">

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm border-bottom">
    <div class="container-fluid mx-5">

        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center" href="/" title="Ir a la página principal">
            <img src="{{ asset('images/Logo2.png') }}" width="50" height="50" class="me-2" title="Logo HomeHive">
            <span class="fw-bold fs-5">HomeHive</span>
        </a>

        <!-- Botón menú -->
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#mainNavbar" title="Abrir menú de navegación">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">

            <ul class="navbar-nav ms-auto align-items-lg-center">

                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="/" title="Ir a la página de inicio">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}" title="Crear una cuenta nueva">Registrarse</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}" title="Acceder a tu cuenta">Iniciar sesión</a>
                    </li>
                @endguest

                @auth

                    @if(Auth::user()->role == 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="/home" title="Ir al panel principal">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/users" title="Administrar usuarios del sistema">Usuarios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/propiedades" title="Gestionar propiedades registradas">Propiedades</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/reviews" title="Revisar comentarios de usuarios">Comentarios</a>
                        </li>
                    @endif

                    @if(Auth::user()->role == 'inquilino')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('buscar')}}" title="Buscar propiedades disponibles">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('pagos')}}" title="Ver y gestionar tus pagos">Pagos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('favoritos')}}" title="Ver tus propiedades favoritas">Favoritos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('solicitudes')}}" title="Revisar tus solicitudes enviadas">Solicitudes</a>
                        </li>
                    @endif

                    @if(Auth::user()->role == 'propietario')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('propietario.index') }}" title="Ir al panel de propietario">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('propietario.index') }}#propiedades-section" title="Administrar tus propiedades">Propiedades</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('solicitudes.index') }}" title="Ver solicitudes de inquilinos">Solicitudes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('pagos.index') }}" title="Gestionar pagos recibidos">Pagos</a>
                        </li>
                    @endif

                    <!-- Usuario -->
                    <li class="nav-item dropdown ms-2">
                        <a class="nav-link d-flex align-items-center" data-bs-toggle="dropdown" title="Opciones de usuario">
                            <span class="text-muted me-2 d-none d-lg-inline">
                                {{ Auth::user()->name }}
                            </span>

                            <img src="{{ Auth::user()->avatar 
                                ? asset('storage/' . Auth::user()->avatar) 
                                : asset('images/user.svg') }}"
                                class="rounded-circle"
                                width="38" height="38"
                                style="object-fit: cover;"
                                title="Perfil de usuario">
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                            <li>
                                <a class="dropdown-item" href="#perfilModal" data-bs-toggle="modal" title="Editar perfil">
                                    Perfil
                                </a>
                            </li>

                            <li><hr class="dropdown-divider"></li>

                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item text-danger" title="Cerrar sesión">
                                        Cerrar sesión
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>

                @endauth
            </ul>
        </div>
    </div>
</nav>

<main class="flex-fill degradado">
    {{ $slot }}
</main>

<footer>
    <div class="container text-center py-4">
        <div class="row">

            <div class="col-md-4">
                <h6>COMPROMISO</h6>
                <small>
                    En HomeHive, nos dedicamos a ofrecer la mejor experiencia en alquileres.
                </small>
            </div>

            <div class="col-md-4 d-flex align-items-center justify-content-center">
                <strong>© 2026 DevSquad</strong>
            </div>

            <div class="col-md-4">
                <div class="row">

                    <div class="col-6">
                        <h6>MÁS</h6>
                        <a href="/comentarios" title="Ver comentarios de usuarios">Comentarios</a><br>
                        <a href="/acerca" title="Conocer más sobre nosotros">Acerca</a>
                    </div>

                    <div class="col-6">
                        <h6>LEGAL</h6>
                        <a href="/politica" title="Leer política de privacidad">Privacidad</a><br>
                        <a href="/terminos" title="Leer términos y condiciones">Términos</a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</footer>

@auth
<div class="modal fade" id="perfilModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4">

            <div class="modal-header border-0">
                <h5 title="Editar información de tu cuenta">Editar Perfil</h5>
                <button class="btn-close" data-bs-dismiss="modal" title="Cerrar"></button>
            </div>

            <div class="modal-body">

                <form action="{{ route('perfil.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="text-center mb-3 position-relative">

                        <img src="{{ Auth::user()->avatar 
                            ? asset('storage/' . Auth::user()->avatar) 
                            : asset('images/user.svg') }}"
                            class="rounded-circle"
                            width="100" height="100"
                            title="Imagen de perfil">

                        <label for="avatar" style="position:absolute; bottom:0; right:40%; cursor:pointer;" title="Cambiar foto">
                            ✏️
                        </label>

                        <input type="file" name="avatar" id="avatar" hidden>
                    </div>

                    <input type="text" name="name" class="form-control mb-2"
                        value="{{ Auth::user()->name }}" required title="Nombre completo">

                    <input type="email" name="email" class="form-control mb-2"
                        value="{{ Auth::user()->email }}" required title="Correo electrónico">

                    <input type="password" name="password"
                        class="form-control mb-2" placeholder="Nueva contraseña" title="Nueva contraseña">

                    <input type="password" name="password_confirmation"
                        class="form-control mb-3" placeholder="Confirmar contraseña" title="Confirmar contraseña">

                    <button class="btn btn-primary w-100" title="Guardar cambios en el perfil">
                        Guardar cambios
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>
@endauth

@stack('scripts')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
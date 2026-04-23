<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'HomeHive' }}</title>

    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/inquilinostyle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Styles.css') }}">
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

<body class="fondo fade-in d-flex flex-column min-vh-100" title="Aplicación HomeHive">

<nav class="navbar navbar-light bg-white shadow-sm border-bottom" title="Barra de navegación principal">
    <div class="container-fluid px-3 d-flex align-items-center">

        <div class="d-flex align-items-center">
            <button class="navbar-toggler d-lg-none me-2"
                    type="button"
                    data-bs-toggle="offcanvas"
                    data-bs-target="#sidebarMenu"
                    title="Abrir menú lateral">
                <span class="navbar-toggler-icon"></span>
            </button>

            <a class="navbar-brand d-flex align-items-center" href="/" title="Ir al inicio">
                <img src="{{ asset('images/Logo2.png') }}" width="50" height="50" class="me-2" title="Logo de HomeHive">
                <span class="fw-bold fs-5">HomeHive</span>
            </a>
        </div>

        <div class="d-none d-lg-flex flex-grow-1 justify-content-end" style="margin-right: 20px;">
            <div class="d-flex align-items-center me-4">
                <a href="{{ asset('downloads/HomeHive.apk') }}" 
                   class="btn btn-primary btn-sm" 
                   download="HomeHive.apk"
                   title="Descargar aplicación móvil">
                    Descarga la app
                </a>
            </div>

            <ul class="navbar-nav flex-row gap-3">
                @guest
                    <li class="nav-item"><a class="nav-link" href="/" title="Ir al inicio">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}" title="Crear cuenta">Registrarse</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}" title="Acceder a tu cuenta">Iniciar sesión</a></li>
                @endguest

                @auth
                    @if(Auth::user()->role == 'admin')
                        <li class="nav-item"><a class="nav-link" href="/home" title="Panel principal">Inicio</a></li>
                        <li class="nav-item"><a class="nav-link" href="/admin/users" title="Gestionar usuarios">Usuarios</a></li>
                        <li class="nav-item"><a class="nav-link" href="/admin/propiedades" title="Gestionar propiedades">Propiedades</a></li>
                        <li class="nav-item"><a class="nav-link" href="/admin/reviews" title="Ver comentarios">Comentarios</a></li>
                    @endif

                    @if(Auth::user()->role == 'inquilino')
                        <li class="nav-item"><a class="nav-link" href="{{ route('buscar') }}" title="Buscar propiedades">Inicio</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('pagos') }}" title="Ver pagos">Pagos</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('favoritos') }}" title="Ver favoritos">Favoritos</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('solicitudes') }}" title="Ver solicitudes">Solicitudes</a></li>
                    @endif

                    @if(Auth::user()->role == 'propietario')
                        <li class="nav-item"><a class="nav-link" href="{{ route('propietario.index') }}" title="Panel principal">Inicio</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('propietario.index') }}#propiedades-section" title="Ver propiedades">Propiedades</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('solicitudes.index') }}" title="Ver solicitudes">Solicitudes</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('pagos.index') }}" title="Ver pagos">Pagos</a></li>
                    @endif
                @endauth
            </ul>
        </div>

        @auth
        <div class="ms-auto">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link d-flex align-items-center" data-bs-toggle="dropdown" style="cursor: pointer" title="Opciones de usuario">
                        <span class="text-muted me-2 d-none d-lg-inline">
                            {{ Auth::user()->name }}
                        </span>
                        <img src="{{ Auth::user()->avatar
                            ? asset('storage/' . Auth::user()->avatar)
                            : asset('images/user.svg') }}"
                            class="rounded-circle"
                            width="38" height="38"
                            title="Foto de perfil">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm position-absolute position-lg-static mt-2 mt-lg-0">
                        <li><a class="dropdown-item" href="#perfilModal" data-bs-toggle="modal" title="Editar perfil">Perfil</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item text-danger" title="Cerrar sesión">Cerrar sesión</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        @endauth
    </div>
</nav>

<div class="offcanvas offcanvas-start d-lg-none" tabindex="-1" id="sidebarMenu" title="Menú lateral">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Menú</h5>
        <button class="btn-close" data-bs-dismiss="offcanvas" title="Cerrar menú"></button>
    </div>
    <div class="offcanvas-body">
        <div class="mb-3">
            <a href="{{ asset('downloads/HomeHive.apk') }}" class="btn btn-primary btn-sm w-100" download="HomeHive.apk">Descarga la app</a>
        </div>
        <ul class="navbar-nav">
            @auth
                <li class="nav-item"><a class="nav-link" href="/home">Inicio</a></li>
                @endauth
        </ul>
    </div>
</div>

<main class="flex-fill degradado" title="Contenido principal">
    {{ $slot }}
</main>

<footer title="Pie de página" class="mt-auto" style="background-color: #1a1a2e; color: #ffffff; border-top: 1px solid #2d2d44;">
    <div class="container text-center py-5">
        <div class="row">
            <div class="col-md-4 mb-4 mb-md-0">
                <h6 class="fw-bold mb-3" style="color: #ffffff;">COMPROMISO</h6>
                <p class="small mb-0" style="color: #d1d1e0; line-height: 1.6;">
                    En HomeHive, nos dedicamos a ofrecer la mejor experiencia en alquileres de propiedades. 
                    Valoramos tus comentarios y sugerencias para mejorar continuamente nuestra plataforma y servicios.
                </p>
            </div>
            
            <div class="col-md-4 d-flex align-items-center justify-content-center mb-4 mb-md-0">
                <span class="fs-5 fw-medium">© 2026 DevSquad</span>
            </div>
            
            <div class="col-md-4">
                <div class="row">
                    <div class="col-6">
                        <h6 class="fw-bold mb-3" style="color: #ffffff;">MÁS</h6>
                        <ul class="list-unstyled">
                            <li><a href="{{ asset('downloads/HomeHive.apk') }}" download="HomeHive.apk" class="text-decoration-underline small" style="color: #d1d1e0;">Descargar app</a></li>
                            <li><a href="/comentarios" class="text-decoration-underline small" style="color: #d1d1e0;">Comentarios</a></li>
                            <li><a href="/acerca" class="text-decoration-underline small" style="color: #d1d1e0;">Acerca de nosotros</a></li>
                        </ul>
                    </div>
                    <div class="col-6">
                        <h6 class="fw-bold mb-3" style="color: #ffffff;">LEGAL</h6>
                        <ul class="list-unstyled">
                            <li><a href="/politica" class="text-decoration-underline small" style="color: #d1d1e0;">Política de privacidad</a></li>
                            <li><a href="/terminos" class="text-decoration-underline small" style="color: #d1d1e0;">Términos y condiciones</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

@auth
<div class="modal fade" id="perfilModal" title="Editar perfil">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4">
            <div class="modal-header border-0">
                <h5>Editar Perfil</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
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
                            width="100" height="100">
                        <label for="avatar" style="position:absolute; bottom:0; right:40%; cursor:pointer;">✏️</label>
                        <input type="file" name="avatar" id="avatar" hidden>
                    </div>
                    <input type="text" name="name" class="form-control mb-2" value="{{ Auth::user()->name }}" required>
                    <input type="email" name="email" class="form-control mb-2" value="{{ Auth::user()->email }}" required>
                    <input type="password" name="password" class="form-control mb-2" placeholder="Nueva contraseña">
                    <input type="password" name="password_confirmation" class="form-control mb-3" placeholder="Confirmar contraseña">
                    <button class="btn btn-primary w-100">Guardar cambios</button>
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
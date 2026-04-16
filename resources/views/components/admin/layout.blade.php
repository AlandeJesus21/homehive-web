<!doctype html>
<html lang="es">

<head>
    <title>Admin</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/Styles.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">



</head>

<body class="fade-in fondo d-flex flex-column min-vh-100">

    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm border-bottom">
            <div class="container-fluid mx-5">

                <!-- LOGO -->
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
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
        ? asset('storage/' . Auth::user()->avatar) 
        : asset('images/user.svg') }}" class="rounded-circle" width="38" height="38" style="object-fit: cover;">
                        </div>

                    </button>

                    <ul class="dropdown-menu dropdown-menu-end shadow-sm">

                        <li>
                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#perfilModal"
                                href="">Perfil</a>
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
                        <li class="nav-item">
                            <a class="nav-link text-black" href="/home">Inicio</a>
                        </li>
                    </ul>
                </div>
        </nav>
    </header>



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
        : asset('images/user.svg') }}" class="rounded-circle" width="100" height="100">

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
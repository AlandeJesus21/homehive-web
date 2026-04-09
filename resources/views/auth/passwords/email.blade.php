<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Recuperar contraseña - HomeHive</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Styles.css') }}">
</head>

<body class="fondo fadeIn">

    <nav class="navbar navbar-light bg-white shadow-sm px-4">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="/">
            <img src="{{ asset('images/Logo2.png') }}" width="40" class="me-2">
            HomeHive
        </a>
    </nav>

    <div class="container-fluid vh-100 d-flex align-items-center">
        <div class="row w-100 h-100">

            <div class="col-md-8 d-none d-md-block p-0 position-relative">

                <div class="h-100 w-100" style="background: url('{{ asset('images/j.jpg') }}') center/cover no-repeat;">

                    <div class="position-absolute top-50 start-50 translate-middle text-white text-center px-4">

                        <h5 class="fw-bold">
                            ¿Olvidaste tu contraseña?
                        </h5>

                        <p>
                            No te preocupes. Introduce tu correo y recibirás un enlace
                            para crear una nueva.
                        </p>

                    </div>

                </div>

            </div>

            <div class="col-md-4 d-flex align-items-center justify-content-center">

                <div class="card shadow-lg border-0 p-4 position-relative"
                    style="width: 100%; max-width: 350px; border-radius: 16px;">

                    <a href="{{ route('login') }}"
                        class="position-absolute top-0 end-0 m-4 text-dark text-decoration-none fs-3">
                        &times;
                    </a>

                    <h5 class="fw-bold mb-3 text-center">
                        Recuperar contraseña
                    </h5>

                    @if (session('status'))
                    <div class="alert alert-success text-center">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label small">Correo electrónico:</label>

                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}" required>

                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="text-center">
                            <button class="btn btn-primary px-4 rounded-pill">
                                Enviar enlace
                            </button>
                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>

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
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Login - HomeHive</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Styles.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
</head>

<body class="fadeIn" style="background-color: #e9ecf2;">

    <div class="container-fluid vh-100">
        <div class="row h-100">

            <div class="col-md-7 d-none d-md-block p-0 position-relative">
                <div class="h-100 w-100" style="background: url('{{ asset('images/j.jpg') }}') center/cover no-repeat;">
                    <div class="position-absolute top-50 start-50 translate-middle text-white text-center px-4">
                        <h4 class="fw-bold">
                            Todo gran cambio empieza con un buen lugar.
                        </h4>
                        <p>
                            Inicia sesión y continúa formando parte de la colmena.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-5 d-flex align-items-center justify-content-center position-relative">

                <div class="card shadow-lg border-0 p-4" style="width: 100%; max-width: 420px; border-radius: 16px;">

                    <a href="/" class="position-absolute top-0 end-0 m-4 text-dark text-decoration-none fs-3">
                        &times;
                    </a>

                    <h3 class="text-center mb-4">Inicia sesión</h3>

                    @if ($errors->has('email'))
                    <div id="loginAlert" class="alert alert-danger text-center py-2">
                        {{ $errors->first('email') }}

                        @if (!str_contains($errors->first('email'), 'Demasiados intentos'))
                        <div class="mt-1">
                            <a href="{{ route('password.request') }}" class="fw-bold text-decoration-none">
                                ¿Olvidaste tu contraseña?
                            </a>
                        </div>
                        @endif
                    </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Correo electrónico</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}" required>

                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Contraseña</label>
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" id="loginBtn" data-blocked="{{ session('blocked') ? 1 : 0 }}"
                                data-seconds="{{ session('seconds') ?? 0 }}" class="btn btn-primary rounded-pill py-2"
                                {{ session('blocked') ? 'disabled' : '' }}>

                                {{ session('blocked') ? 'A intentado muchas veces. Intente nuevamente más tarde' : 'Iniciar sesión' }}

                            </button>
                        </div>

                    </form>

                    <div class="text-center mt-4">
                        <small>
                            ¿No tienes cuenta?
                            <a href="{{ route('register') }}">Regístrate aquí</a>
                        </small>
                    </div>

                    <hr>

                    <div class="text-center mt-3">
                        <a href="/google-auth/redirect"
                            class="btn btn-outline-secondary rounded-pill py-2 d-inline-flex align-items-center gap-2">
                            <img src="{{ asset('images/google.png') }}" height="25">
                            Iniciar sesión con Google
                        </a>
                    </div>

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

    <script>
    document.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', function(e) {
            if (this.href && !this.href.includes('#')) {
                e.preventDefault();
                document.body.classList.add('fade-out');
                setTimeout(() => {
                    window.location = this.href;
                }, 300);
            }
        });
    });
    </script>

    <script>
    const btn = document.getElementById('loginBtn');
    const alertBox = document.getElementById('loginAlert');

    const blocked = btn.dataset.blocked == "1";
    const segundos = parseInt(btn.dataset.seconds);

    if (blocked && segundos > 0) {
        let tiempo = segundos;

        btn.disabled = true;

        let intervalo = setInterval(() => {
            tiempo--;

            btn.innerText = "Intenta en " + tiempo + "s";

            if (tiempo <= 0) {
                clearInterval(intervalo);

                btn.disabled = false;
                btn.innerText = "Iniciar sesión";

                if (alertBox) {
                    alertBox.style.opacity = "0";
                    setTimeout(() => {
                        alertBox.style.display = "none";
                    }, 300);
                }
            }
        }, 1000);
    }
    </script>

</body>

</html>
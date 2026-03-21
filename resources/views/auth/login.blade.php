<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Login - HomeHive</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/Styles.css') }}">

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

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class=" mb-3">
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

                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary rounded-pill py-2">
                                Iniciar sesión
                            </button>
                        </div>

                    </form>

                    <div class="text-center mt-4">
                        <small>
                            ¿No tienes cuenta?
                            <a href="{{ route('register') }}">Regístrate aquí</a>
                        </small>
                    </div>
                    <!-- <p class="text-center mb-4">o</p> -->
                    <hr>
                    <div class="text-center mt-3">
                        <div class="navbar-brand btn btn-outline-secondary rounded-pill py-2 ">
                            <a href="/google-auth/redirect" class="text-decoration-none text-dark">
                                <img src="{{ asset('images/Google.png') }}" alt="HomeHive" height="30"> Iniciar sesión
                                con Google
                            </a>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    </div>

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

</body>

</html>
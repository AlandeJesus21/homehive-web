<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>HomeHive</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/Styles.css') }}">

</head>


<body class="fadeIn" style="background-color: #e9ecf2;">

    <div class="container-fluid vh-100">
        <div class="row h-100">

            {{-- IMAGEN IZQUIERDA --}}
            <div class="col-md-7 d-none d-md-block p-0 position-relative">
                <div class="h-100 w-100" style="background: url('{{ asset('images/j.jpg') }}') center/cover no-repeat;">

                    <div class="position-absolute top-50 start-50 translate-middle text-white text-center px-4">
                        <h4 class="fw-bold">
                            Encuentra tu nuevo comienzo.
                        </h4>
                        <p>
                            Comienza una nueva etapa con HomeHive Regístrate y forma parte de nuestra colmena de
                            hogares.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-5 d-flex align-items-center justify-content-center position-relative">



                <div class="card shadow-lg border-0 p-4" style="width: 100%; max-width: 450px; border-radius: 16px;">

                    <a href="/" class="position-absolute top-0 end-0 m-4 text-dark text-decoration-none fs-3">
                        &times;
                    </a>

                    <h3 class="text-center mb-4">Crear cuenta</h3>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <input type="hidden" name="from" value="{{ request()->query('from') }}">

                        <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" required autofocus>

                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Correo electrónico</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required>

                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label class="form-label">Contraseña</label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required>

                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Confirmar contraseña</label>
                            <input id="password-confirm" type="password" class="form-control"
                                name="password_confirmation" required>
                        </div>

                        {{-- ROL --}}
                        <div class="mb-3">
                            <label class="form-label">Seleccione su rol</label>

                            <select name="role" class="form-select @error('role') is-invalid @enderror" required>
                                <option value="">Selecciona una opción</option>
                                <option value="inquilino" {{ old('role') == 'inquilino' ? 'selected' : '' }}>
                                    Inquilino
                                </option>
                                <option value="propietario" {{ old('role') == 'propietario' ? 'selected' : '' }}>
                                    Propietario
                                </option>
                            </select>

                            @error('role')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary rounded-pill py-2">
                                Registrarse
                            </button>
                        </div>

                    </form>

                    <div class="text-center mt-4">
                        <small>
                            ¿Ya tienes cuenta?
                            <a href="{{ route('login') }}">Inicia sesión</a>
                        </small>
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

</html>
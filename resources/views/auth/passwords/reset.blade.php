<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Restablecer contraseña - HomeHive</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">



    <style>
    body {
        background: #e9ecf2;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    .card-custom {
        border-radius: 18px;
        padding: 30px;
    }

    .btn-primary {
        background-color: #1f3a8a;
        border: none;
        border-radius: 20px;
        padding: 10px;
    }

    .btn-primary:hover {
        background-color: #172554;
    }

    .logo {
        width: 90px;
    }
    </style>
</head>

<body>

    <nav class="navbar bg-white shadow-sm px-4">
        <a href="/" class="navbar-brand fw-bold d-flex align-items-center gap-2">
            <img src="{{ asset('images/Logo2.png') }}" class="logo">
            HomeHive
        </a>
    </nav>

    <div class="container flex-grow-1 d-flex align-items-center justify-content-center">

        <div class="card shadow-lg border-0 card-custom" style="max-width: 450px; width:100%;">

            <h4 class="text-center mb-4">Restablecer contraseña</h4>

            @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
                @endforeach
            </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="mb-3">
                    <label class="form-label">Correo electrónico</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        value="{{ $email ?? old('email') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nueva contraseña</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                        required>
                </div>

                <div class="mb-4">
                    <label class="form-label">Confirmar contraseña</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">
                        Restablecer contraseña
                    </button>
                </div>

            </form>

        </div>

    </div>

    <!-- FOOTER -->
    <footer class="text-center py-3">
        <small>© 2026 HomeHive</small>
    </footer>

</body>

</html>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Verificar correo - HomeHive</title>
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

    .icon-mail {
        font-size: 50px;
    }

    .img-email {
        margin-top: 20px;
        margin-left: 50px
    }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar bg-white shadow-sm px-4">
        <a href="/" class="navbar-brand fw-bold d-flex align-items-center gap-2">
            <img src="{{ asset('images/Logo2.png') }}" class="logo" style="width: 40px; height: 40px; margin-left: 20px;">
            HomeHive
        </a>
    </nav>

    <!-- CONTENIDO -->
    <div class="container flex-grow-1 d-flex align-items-center justify-content-center">

        <div class="card shadow-lg border-0 card-custom text-center" style="max-width: 500px; width:100%;">

            <div class="text-cen">
                <img src="{{ asset('images/gmail.png') }}" width="120" class="img-email" style="margin-right: 50px;">

            </div>

            <h4 class="mb-3">Verifica tu correo electrónico</h4>

            <p class="text-muted">
                Antes de continuar, revisa tu correo y haz clic en el enlace de verificación.
            </p>

            <!-- MENSAJE DE ÉXITO -->
            @if (session('message'))
            <div class="alert alert-success">
                Se ha enviado un nuevo enlace de verificación a tu correo.
            </div>
            @endif

            <p class="small text-muted">
                ¿No recibiste el correo?
            </p>

            <!-- REENVIAR -->
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary">
                        Reenviar correo
                    </button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-outline-danger btn-sm">
                    Cerrar sesión
                </button>
            </form>

        </div>

    </div>

    <!-- FOOTER -->
    <footer class="text-center py-3">
        <small>© 2026 HomeHive</small>
    </footer>

</body>

</html>
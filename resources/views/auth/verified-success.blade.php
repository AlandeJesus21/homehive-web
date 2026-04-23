<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Correo verificado - HomeHive</title>
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
        <div class="card shadow-lg border-0 card-custom text-center" style="max-width: 500px; width:100%;">

            <h4 class="mb-3">Correo verificado correctamente</h4>

            <p class="text-muted">
                Puedes cerrar la pestaña y regresar a la aplicación
            </p>

        </div>
    </div>

    <footer class="text-center py-3">
        <small>© 2026 HomeHive</small>
    </footer>

    <script>
        const isMobile = /Android|iPhone|iPad/i.test(navigator.userAgent);

        if (isMobile) {
           return redirect("homehive://auth?token=$token");
        }

        setTimeout(() => {
            window.location.href = "/home";
        }, 2000);
    </script>

</body>
</html>
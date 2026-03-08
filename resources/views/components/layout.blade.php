<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'HomeHive' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
    body {
        margin: 0;
        padding: 0;
    }

    .fondo {
        background-color: #e9ecf2;
    }

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


    footer {
        background-color: #111;
        color: #ccc;
        padding: 20px 0;
    }

    footer a {
        color: #ccc;
        text-decoration: none;
    }

    footer a:hover {
        color: white;
    }




    .h:hover {
        background-color: #3003c4;
        color: #fffefe;
        transition: background-color 0.3s, color 0.3s;
    }

    .hero-content {
        opacity: 0;
        transform: translateY(30px);
        animation: fadeUp 0.8s ease-out forwards;
    }

    .hero-content h1 {
        animation-delay: 0.2s;
    }

    .hero-content h3 {
        animation-delay: 0.4s;
    }

    .hero-content a {
        animation-delay: 0.6s;
    }


    @keyframes fadeUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    </style>
</head>

<body class="fondo hero-content">

    <nav class="navbar navbar-expand-lg bg-light shadow-sm h-60 inline-block" style="background-color: #fbfcff;">
        <div class="container hero-content">
            <a href="" class="navbar-brand fw-bold">
                <img src="{{ asset('images/Logo2.png') }}" alt="HomeHive" height="50"> HomeHive
            </a>

            <ul class="navbar-nav ms-auto flex-row gap-4">
                <li class="nav-item">
                    <a class="nav-link" href="/">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">Registrarse</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Iniciar sesión</a>
                </li>
            </ul>
        </div>
    </nav>

    {{ $slot }}

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
                    <a href="#">Comentarios</a><br>
                    <a href="#">Acerca de nosotros</a><br><br>
                    <h6>LEGAL</h6>
                    <a href="#">Política de privacidad</a><br>
                    <a href="#">Términos y condiciones</a>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>
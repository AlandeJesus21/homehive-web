<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title><?php echo e($title ?? 'HomeHive'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/Styles.css')); ?>">

    <style>
    .hero {
        height: 92vh;
        background: linear-gradient(rgba(0, 0, 0, 0.55), rgba(0, 0, 0, 0.55)),
        url('<?php echo e(asset('images/j.jpg')); ?>') center/cover no-repeat;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: white;
    }
    </style>

</head>

<body class="fondo hero-content">

    <nav class="navbar navbar-expand-lg bg-light shadow-sm h-60 inline-block" style="background-color: #fbfcff;">
        <div class="container hero-content">
            <a href="" class="navbar-brand fw-bold">
                <img src="<?php echo e(asset('images/Logo2.png')); ?>" alt="HomeHive" height="50"> HomeHive
            </a>

            <ul class="navbar-nav ms-auto flex-row gap-4">
                <?php if(auth()->guard()->guest()): ?>

                <li class="nav-item">
                    <a class="nav-link" href="/">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('register')); ?>">Registrarse</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('login')); ?>">Iniciar sesión</a>
                </li>
                <?php endif; ?>
                <?php if(auth()->guard()->check()): ?>
                <li class="nav-item">
                    <a class="nav-link" href="/home">Inicio</a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <?php echo e($slot); ?>


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

</html><?php /**PATH C:\webapps\laravel\homehive-web\resources\views/components/layout.blade.php ENDPATH**/ ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Recuperar contraseña</title>
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">

</head>

<body style="font-family: Arial; text-align:center; padding:40px;">

    <img src="https://homehive.site/images/Logo2.png" width="120" style="margin-bottom:20px;">

    <h2>Hola {{ $user->name }}</h2>

    <p>Recibimos una solicitud para restablecer tu contraseña.</p>

    <a href="{{ $url }}"
        style="display:inline-block; margin-top:20px; padding:12px 25px; background:#1f3a8a; color:white; text-decoration:none; border-radius:8px;">
        Restablecer contraseña
    </a>

    <p style="margin-top:20px;">Este enlace expirará en 60 minutos.</p>

    <p>Si no solicitaste esto, puedes ignorar este correo.</p>

    <p style="margin-top:30px;"><strong>Equipo HomeHive</strong></p>

</body>

</html>
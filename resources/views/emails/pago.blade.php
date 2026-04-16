.<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pago Confirmado</title>
</head>
<body style="font-family: Arial, sans-serif; text-align:center; padding:40px; color: #333;">

    <img src="http://82.25.91.145/images/Logo2.png" width="120" style="margin-bottom:20px;">

    <h2>Hola {{ $user->name }}</h2>

    <p style="font-size: 16px;">Te confirmamos que hemos recibido con éxito tu pago de renta.</p>

    <div style="background: #f3f4f6; padding: 20px; border-radius: 12px; display: inline-block; margin: 20px 0; text-align: left;">
        <p style="margin: 5px 0;"><strong>Propiedad:</strong> {{ $pago->propiedad->titulo }}</p>
        <p style="margin: 5px 0;"><strong>Monto:</strong> ${{ number_format($pago->monto, 2) }}</p>
        <p style="margin: 5px 0;"><strong>Folio:</strong> #{{ $pago->id }}</p>
    </div>

    <br>

    <a href="{{ route('pagos') }}"
        style="display:inline-block; margin-top:20px; padding:12px 25px; background:#1f3a8a; color:white; text-decoration:none; border-radius:8px; font-weight: bold;">
        Ver mis pagos
    </a>

    <p style="margin-top:30px;">Gracias por confiar en nosotros.</p>

    <p style="margin-top:20px;"><strong>Equipo HomeHive</strong></p>

</body>
</html>
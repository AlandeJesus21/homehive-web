<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Notificación de Solicitud</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f7fa; font-family: sans-serif;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td align="center" style="padding: 40px 10px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 15px rgba(0,0,0,0.1);">
                    <tr>
                        <td align="center" style="padding: 30px; border-bottom: 1px solid #f0f0f0;">
                            <img src="https://homehive.site/images/Logo2.png" width="150" alt="HomeHive">
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 40px;">
                            <h2 style="color: #1a202c; text-align: center;">¡Hola, {{ $user->name }}!</h2>
                            <p style="font-size: 16px; color: #4a5568; text-align: center; line-height: 1.5;">
                                {!! $cuerpo !!}
                            </p>

                            <div style="background-color: #f8fafc; border: 1px solid #e2e8f0; padding: 20px; border-radius: 10px; margin-top: 25px;">
                                <p style="margin: 5px 0;"><strong>Propiedad:</strong> {{ $solicitud->propiedad }}</p>
                                <p style="margin: 5px 0;"><strong>Estatus:</strong> {{ $solicitud->estatus }}</p>
                                <p style="margin: 5px 0;"><strong>Fecha:</strong> {{ $solicitud->fecha }}</p>
                            </div>

                            <div style="text-align: center; margin-top: 35px;">
                                <a href="{{ url('/') }}" style="background-color: #1e3a8a; color: #ffffff; padding: 15px 30px; border-radius: 8px; text-decoration: none; font-weight: bold; display: inline-block;">
                                    {{ $boton_texto }}
                                </a>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
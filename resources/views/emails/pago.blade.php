<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago Confirmado</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f7fa; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">

    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td align="center" style="padding: 40px 10px;">
                
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);">
                    
                    <tr>
                        <td align="center" style="padding: 40px 40px 20px 40px; border-bottom: 1px solid #f0f0f0;">
                            <img src="https://homehive.site/images/Logo2.png" width="160" alt="HomeHive" style="display: block;">
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 40px;">
                            <h2 style="color: #1a202c; font-size: 26px; margin: 0 0 20px 0; text-align: center; font-weight: 700;">
                                ¡Hola, {{ $user->name }}!
                            </h2>
                            
                            <p style="font-size: 18px; line-height: 1.6; color: #4a5568; margin: 0 0 30px 0; text-align: center;">
                                Te confirmamos que hemos recibido con éxito tu pago de renta. Aquí tienes los detalles de la transacción:
                            </p>

                            <div style="background-color: #f8fafc; border: 1px solid #e2e8f0; padding: 25px; border-radius: 12px;">
                                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td style="padding-bottom: 12px; font-size: 16px; color: #718096;">Propiedad:</td>
                                        <td style="padding-bottom: 12px; font-size: 16px; color: #1a202c; font-weight: 600; text-align: right;">
                                            {{ $pago->propiedad->titulo }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-bottom: 12px; font-size: 16px; color: #718096;">Monto Pagado:</td>
                                        <td style="padding-bottom: 12px; font-size: 20px; color: #2d3748; font-weight: 700; text-align: right;">
                                            ${{ number_format($pago->monto, 2) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 16px; color: #718096;">Folio de Operación:</td>
                                        <td style="font-size: 16px; color: #1a202c; font-weight: 600; text-align: right;">
                                            #{{ $pago->id }}
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div style="text-align: center; margin-top: 40px;">
                                <a href="{{ route('pagos') }}" 
                                   style="display: inline-block; background-color: #1e3a8a; color: #ffffff; padding: 18px 35px; border-radius: 10px; text-decoration: none; font-weight: bold; font-size: 16px; letter-spacing: 0.5px;">
                                    Ver historial de pagos
                                </a>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td align="center" style="padding: 30px 40px; background-color: #f8fafc; border-top: 1px solid #f0f0f0;">
                            <p style="margin: 0 0 10px 0; font-size: 15px; color: #4a5568;">Gracias por confiar en <strong>HomeHive</strong>.</p>
                            <p style="margin: 0; font-size: 14px; color: #718096; font-weight: bold;">Equipo de Soporte HomeHive</p>
                        </td>
                    </tr>

                </table>
                
                <p style="margin-top: 25px; font-size: 12px; color: #a0aec0; text-align: center; max-width: 600px;">
                    Has recibido este correo porque se realizó un pago en tu cuenta de homehive.site. 
                    Si no reconoces esta actividad, por favor contáctanos de inmediato.
                </p>

            </td>
        </tr>
    </table>

</body>
</html>
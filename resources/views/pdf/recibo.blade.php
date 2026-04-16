<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Recibo de Pago - {{ $pago->id }}</title>
    <style>
        /* 1. RESET Y CONFIGURACIÓN DE COLOR DE FONDO */
        @page { margin: 0cm; }
        
        body { 
            margin: 0; 
            padding: 0; 
            font-family: 'Helvetica', sans-serif; 
            /* Cambiamos el gris oscuro por un blanco hueso casi imperceptible */
            background-color: #fafafa; 
            color: #333;
        }

        /* 2. CONTENEDOR PRINCIPAL */
        .wrapper-table {
            width: 100%;
            border-collapse: collapse;
        }

        .content-cell {
            padding: 30px 0;
            vertical-align: top;
            text-align: center;
        }

        .main-card {
            background-color: white;
            width: 92%; 
            max-width: 750px;
            margin: 0 auto;
            text-align: left;
            padding: 40px;
            /* Suavizamos la sombra para que no sea tan pesada */
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            border: 1px solid #eee;
        }

        /* 3. DISEÑO INTERNO */
        .header { 
            text-align: center; 
            border-bottom: 2px solid #2b448c; 
            padding-bottom: 15px; 
            margin-bottom: 30px; 
        }
        .logo { font-size: 28px; font-weight: bold; color: #2b448c; margin: 0; }
        
        .data-table { width: 100%; border-collapse: collapse; }
        .data-table td { padding: 12px 5px; border-bottom: 1px solid #f9f9f9; font-size: 14px; }
        .label { color: #666; width: 40%; }
        .value { text-align: right; font-weight: bold; color: #111; }

        .total-container { margin-top: 35px; text-align: right; }
        .total-box { 
            display: inline-block; 
            background-color: #fcfcfc; 
            padding: 15px 25px; 
            border: 1px solid #efefef;
            border-radius: 6px;
        }

        .footer { text-align: center; font-size: 10px; color: #aaa; margin-top: 40px; line-height: 1.4; }

        /* 4. BOTONES (Solo pantalla) */
        .btn-nav { text-align: center; margin-top: 20px; margin-bottom: 10px; }
        .btn { 
            padding: 10px 20px; text-decoration: none; border-radius: 5px; 
            font-size: 13px; font-weight: bold; display: inline-block; margin: 0 8px; 
        }
        .btn-back { background-color: #f3f4f6; color: #4b5563 !important; border: 1px solid #d1d5db; }
        .btn-pdf { background-color: #2b448c; color: white !important; }

        /* AJUSTES ESPECÍFICOS PARA EL PDF */
        @media print {
            body { background-color: white; }
            .content-cell { padding: 0.5cm; }
            .main-card { 
                width: 100%; 
                box-shadow: none; 
                border: none;
                padding: 1cm;
            }
            .btn-nav { display: none !important; }
        }
    </style>
</head>
<body>

    @if(!request()->has('download'))
        <div class="btn-nav">
            <a href="{{ auth()->user()->role == 'propietario' ? route('pagos.index') : route('pagos') }}" class="btn btn-back">← Volver</a>
            <a href="{{ request()->fullUrlWithQuery(['download' => 1]) }}" class="btn btn-pdf">Descargar PDF Oficial</a>
        </div>
    @endif

    <table class="wrapper-table">
        <tr>
            <td class="content-cell">
                <div class="main-card">
                    <div class="header">
                        <h1 class="logo">HomeHive</h1>
                        <div style="font-size: 11px; color: #666; margin-top: 5px; letter-spacing: 1px;">COMPROBANTE DE PAGO OFICIAL</div>
                    </div>

                    <table class="data-table">
                        <tr>
                            <td class="label">Folio de Operación:</td>
                            <td class="value">#{{ $pago->id }}</td>
                        </tr>
                        <tr>
                            <td class="label">Fecha y Hora:</td>
                            <td class="value">{{ $pago->updated_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        <tr>
                            <td class="label">Propiedad Arrendada:</td>
                            <td class="value">{{ $pago->propiedad->titulo }}</td>
                        </tr>
                        <tr>
                            <td class="label">Nombre Inquilino:</td>
                            <td class="value">{{ $pago->inquilino->name }}</td>
                        </tr>
                        <tr>
                            <td class="label">Nombre Arrendador:</td>
                            <td class="value">{{ $pago->arrendador->name }}</td>
                        </tr>
                        <tr>
                            <td class="label">Estatus:</td>
                            <td class="value" style="color: #059669;">PAGADO / VERIFICADO</td>
                        </tr>
                    </table>

                    <div class="total-container">
                        <div class="total-box">
                            <span style="font-size: 11px; color: #64748b; display: block;">MONTO TOTAL LIQUIDADO</span>
                            <span style="font-size: 22px; font-weight: bold; color: #1e293b;">${{ number_format($pago->monto, 2) }} MXN</span>
                        </div>
                    </div>

                    <div class="footer">
                        <p>ID Transacción Stripe: {{ $pago->stripe_id ?? 'N/A' }}</p>
                        <p>Este documento es un comprobante de pago electrónico generado por HomeHive.<br>
                        "Donde cada estancia se siente como hogar"</p>
                    </div>
                </div>
            </td>
        </tr>
    </table>

</body>
</html>
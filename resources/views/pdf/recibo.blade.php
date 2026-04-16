<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Recibo de Pago - {{ $pago->id }}</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; color: #333; }
        .header { text-align: center; margin-bottom: 30px; }
        .logo { font-size: 24px; font-weight: bold; color: #1F2937; }
        .details { margin-bottom: 20px; width: 100%; border-collapse: collapse; }
        .details td { padding: 8px; border-bottom: 1px solid #eee; }
        .total { font-size: 20px; font-weight: bold; text-align: right; margin-top: 20px; }
        .footer { text-align: center; font-size: 12px; color: #777; margin-top: 50px; }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">HomeHive</div>
        <p>Comprobante de Pago Oficial</p>
    </div>

    <table class="details">
        <tr>
            <td><strong>Folio de Pago:</strong></td>
            <td>#{{ $pago->id }}</td>
        </tr>
        <tr>
            <td><strong>Fecha:</strong></td>
            <td>{{ $pago->updated_at->format('d/m/Y H:i') }}</td>
        </tr>
        <tr>
            <td><strong>Propiedad:</strong></td>
            <td>{{ $pago->propiedad->titulo }}</td>
        </tr>
        <tr>
            <td><strong>Inquilino:</strong></td>
            <td>{{ $pago->inquilino->name }}</td>
        </tr>
        <tr>
            <td><strong>Arrendador:</strong></td>
            <td>{{ $pago->arrendador->name }}</td>
        </tr>
        <tr>
            <td><strong>Estatus:</strong></td>
            <td style="color: green; font-weight: bold;">PAGADO (Stripe)</td>
        </tr>
    </table>

    <div class="total">
        Monto Total: ${{ number_format($pago->monto, 2) }}
    </div>

    <div class="footer">
        Este es un documento generado automáticamente por la plataforma HomeHive.
    </div>
</body>
</html>
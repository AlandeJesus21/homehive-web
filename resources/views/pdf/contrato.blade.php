<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: 'Helvetica', sans-serif; font-size: 13px; line-height: 1.6; color: #1F2937; padding: 20px; }
        .header { text-align: center; border-bottom: 2px solid #1E3A8A; margin-bottom: 20px; padding-bottom: 10px; }
        .titulo { font-weight: bold; font-size: 20px; color: #1E3A8A; text-transform: uppercase; }
        .dato { font-weight: bold; color: #111827; }
        .clausula-titulo { font-weight: bold; text-decoration: underline; margin-top: 15px; display: block; }
        .lista { margin-left: 20px; margin-top: 5px; }
        .validez-nota { background: #F3F4F6; padding: 10px; border-radius: 5px; border-left: 4px solid #7F1D1D; margin-top: 20px; font-style: italic; }
        .firma-box { margin-top: 60px; width: 100%; }
        .col { width: 45%; display: inline-block; text-align: center; border-top: 1px solid #000; padding-top: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <div class="titulo">Contrato de Arrendamiento</div>
        <p>HomeHive - Folio Digital: #{{ $pago->id }}-{{ date('Y') }}</p>
    </div>

    <p>En la ciudad de <strong>Ocosingo, Chiapas</strong>, con fecha de <span class="dato">{{ $pago->created_at->format('d/m/Y') }}</span>.</p>
    
    <p><strong>REUNIDOS:</strong></p>
    <p>Por una parte como <b>ARRENDADOR</b>: <span class="dato">{{ $pago->arrendador->name }}</span>.</p>
    <p>Por otra parte como <b>ARRENDATARIO</b>: <span class="dato">{{ $pago->inquilino->name }}</span>.</p>

    <p><strong>CLÁUSULAS:</strong></p>

    <span class="clausula-titulo">PRIMERA: OBJETO Y UBICACIÓN</span>
    <p>El Arrendador concede el uso y goce temporal del inmueble tipo <span class="dato">{{ ucfirst($pago->propiedad->tipo) }}</span> denominado "<span class="dato">{{ $pago->propiedad->titulo }}</span>", ubicado en <span class="dato">{{ $pago->propiedad->calle }}, Barrio {{ $pago->propiedad->barrio->nombre }}</span>.</p>

    <span class="clausula-titulo">SEGUNDA: SERVICIOS INCLUIDOS</span>
    <p>La propiedad se entrega con los siguientes servicios activos conforme al registro de la plataforma:</p>
    <div class="lista">
        @php $servicios = json_decode($pago->propiedad->servicio); @endphp
        @if(is_array($servicios))
            @foreach($servicios as $s)
                • {{ ucfirst(str_replace('_', ' ', $s)) }}<br>
            @endforeach
        @else
            • No se especificaron servicios.
        @endif
    </div>

    <span class="clausula-titulo">TERCERA: REGLAS DE LA PROPIEDAD</span>
    <p>El Arrendatario se compromete a respetar y cumplir las siguientes normativas establecidas por el Arrendador:</p>
    <p style="white-space: pre-line;">{{ $pago->propiedad->reglas }}</p>

    <span class="clausula-titulo">CUARTA: PAGO Y VERIFICACIÓN</span>
    <p>El precio de la renta se pacta en <span class="dato">${{ number_format($pago->monto, 2) }} MXN</span>. Se hace constar que el pago ha sido <span class="dato">CONFIRMADO Y VERIFICADO</span>. Dicha transacción se realizó mediante la modalidad de <b>{{ $pago->forma_pago }}</b> utilizando el puente tecnológico de pagos seguros <b>Stripe</b>, bajo el ID de seguimiento: <small>{{ $pago->stripe_id }}</small>.</p>

    <div class="validez-nota">
        <strong>AVISO DE VALIDEZ:</strong> Este documento digital constituye una constancia de los acuerdos pactados en HomeHive. No obstante, para su plena validez legal y ejecución ante las autoridades competentes, <strong>el presente contrato deberá ser firmado de puño y letra por ambas partes</strong> en las secciones correspondientes al calce.
    </div>

    <div class="firma-box">
        <div class="col" style="margin-right: 5%;">
            <strong>{{ $pago->arrendador->name }}</strong><br>
            Firma del Arrendador
        </div>
        <div class="col">
            <strong>{{ $pago->inquilino->name }}</strong><br>
            Firma del Arrendatario
        </div>
    </div>

    <div style="margin-top: 30px; text-align: center; font-size: 10px; color: #9CA3AF;">
        Documento generado electrónicamente por HomeHive - {{ date('d/m/Y H:i') }}
    </div>
</body>
</html>
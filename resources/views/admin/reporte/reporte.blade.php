<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reporte Mensual de Propiedades</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
    }

    /* Logo a la izquierda */
    .logo {
        float: left;
        width: 100px;
        height: auto;
        margin-bottom: 10px;
    }

    h1 {
        text-align: center;
        margin-top: 0;
    }

    p.fecha {
        clear: both;
        margin-top: 5px;
        font-size: 14px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background-color: #fff;
        margin-top: 10px;
    }

    th,
    td {
        border: 1px solid #ccc;
        padding: 8px 12px;
        text-align: center;
    }

    th {
        background-color: #343a40;
        color: white;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    tr {
        page-break-inside: avoid;
        /* evita que una fila se corte */
    }

    .badge {
        padding: 2px 6px;
        border-radius: 4px;
        color: white;
        font-size: 12px;
    }

    .bg-success {
        background-color: #28a745;
    }

    .bg-secondary {
        background-color: #6c757d;
    }

    .img-tabla {
        width: 80px;
        height: 50px;
        object-fit: cover;
        border-radius: 4px;
    }
    </style>
</head>

<body>

    <img src="{{ public_path('images/Logo2.png') }}" alt="Logo" class="logo">

    <h1>Reporte Mensual de Propiedades</h1>
    <div style="text-align: right; font-size: 12pt;">
        Fecha del reporte: {{ date('d/m/Y') }}
    </div>
    @php
    \Carbon\Carbon::setLocale('es');
    @endphp
    <p>
        Total de propiedades registradas este mes: <strong>{{ now()->translatedFormat('F Y') }}</strong>
    </p>

    <table>
        <thead>
            <tr>
                <th>Título</th>
                <th>Tipo</th>
                <th>Barrio</th>
                <th>Arrendador</th>
                <th>Fecha de registro</th>
            </tr>
        </thead>
        <tbody>
            @foreach($properties as $propiedad)
            <tr>
                <td>{{ $propiedad->titulo }}</td>
                <td>{{ ucfirst($propiedad->tipo) }}</td>
                <td>{{ $propiedad->barrio }}</td>
                <td>{{ $propiedad->user->name }}
                    <br>
                    <small>{{ $propiedad->user->email }}</small>
                </td>
                <td>{{ $propiedad->created_at->format('d/m/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
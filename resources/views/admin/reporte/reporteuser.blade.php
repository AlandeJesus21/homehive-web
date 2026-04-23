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

    <h1>Listado de Usuarios</h1>
    <div style="text-align: right; font-size: 12pt;">
        Fecha del reporte: {{ date('d/m/Y') }}
    </div>
    <br>

    <table id="myTable">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Correo Electrónico</th>
                <th>Rol</th>
                <th>Fecha de registro</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr class="text-center">
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>{{ $user->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
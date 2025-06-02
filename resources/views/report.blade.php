<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reporte de reservas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 10px;
            text-align: center;
        }

        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 10px;
        }

        table {
            width: 50%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            margin: 0 auto;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 5px;
            text-align: center;
        }

        th {
            background-color: #4a90e2;
            color: white;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .confirmado {
            background-color: #d4edda;
            color:rgb(21, 87, 36);
            padding: 5px 10px;
            border-radius: 4px;
        }

        .pendiente {
            background-color: #fff3cd;
            color:rgb(133, 100, 4);
            padding: 5px 10px;
            border-radius: 4px;
        }

        .cancelado {
            background-color: #f8d7da;
            color:rgb(114, 28, 36);
            padding: 5px 10px;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <h1>Listado de Reservas</h1>
    <table>
        <tr>
            <th>ID Reserva</th>
            <th>Huésped</th>
            <th>Hotel</th>
            <th>Check-in</th>
            <th>Check-out</th>
            <th>Número de Habitaciones</th>
            <th>Estado</th>
            <th>Precio</th>
        </tr>
        @foreach ($reservas as $reserva)
            <tr>
                <td>{{ $reserva->idreserva }}</td>
                <td>{{ $reserva->usuario->name }}</td>
                <td>{{ $reserva->hotel->nombre }}</td>
                <td>{{ $reserva->fecha_entrada }}</td>
                <td>{{ $reserva->fecha_salida }}</td>
                <td>{{ $reserva->num_habitaciones }}</td>
                <td>
                    @if($reserva->estado == 'Confirmado')
                        <span class="confirmado">Confirmado</span>
                    @elseif($reserva->estado == 'Pendiente')
                        <span class="pendiente">Pendiente</span>
                    @else
                        <span class="cancelado">Cancelado</span>
                    @endif
                </td>
                <td>€{{ $reserva->total_pagar }}</td>
            </tr>
        @endforeach
    </table>
</body>
</html>

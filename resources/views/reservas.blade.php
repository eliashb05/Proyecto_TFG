@extends('master')
@include('layouts.navbar')
<!-- Para seguridad CSRF en AJAX -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
@section('contenido')
<style>
        .table-hover tr:hover {
            background-color: #f8f9fa;
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

        .table th {
            background-color:rgb(32, 89, 155);
            color: white;
            font-weight: 500;
        }

        .nombre-usuario {
            font-weight: 500;
            color: #2c3e50;
        }

        .nombre-hotel {
            font-weight: 500;
        }

        .action-buttons button {
            padding: 4px 8px;
            margin: 0 2px;
        }
    </style>

<body class="bg-light">
    <div class="container my-5">
        <h2 class="mt-4 text-center">Lista de Reservas</h2>
        <h5 class="mb-4 text-center">Confirma ahora tu reserva o cancelala antes de la fecha</h5>
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                <!-- Para mostrar mensajes de exito y error -->
                <div id="mensajeReserva" class="alert d-none text-center"></div>
                <!-- Tabla para mostrar las reservas -->
                    <table class="table table-hover mb-0 text-center">
                            <tr>
                                <th>ID Reserva</th>
                                <th>Huésped</th>
                                <th>Hotel</th>
                                <th>Check-in</th>
                                <th>Check-out</th>
                                <th>Numero de Habitaciones</th>
                                <th>Estado</th>
                                <th>Precio</th>
                                <th></th>
                            </tr>
                        <!-- Recorre las reservas y las muestra en la tabla -->
                            @foreach ($reservas as $reserva)
                                <tr>
                                    <td>{{ $reserva->idreserva }}</td>
                                    <td class="nombre-usuario">{{ $reserva->usuario->name }}</td>
                                    <td class="nombre-hotel">{{ $reserva->hotel->nombre }}</td>
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
                                    <td>{{ $reserva->total_pagar }}€</td>
                                    <td class="action-buttons d-flex">
                                     <!-- Botón Confirmar (deshabilitado si estado es Confirmado) -->
                                    <button type="button" class="btn btn-sm btn-outline-primary btn-confirmar" data-id="{{ $reserva->idreserva }}" @if($reserva->estado == 'Confirmado') disabled @endif>
                                        <i class="fas fa-check"></i> Confirmar
                                    </button>

                                    <!-- Botón Cancelar (deshabilitado si estado es Cancelado) -->
                                    <button type="button" class="btn btn-sm btn-outline-danger btn-cancelar" data-id="{{ $reserva->idreserva }}" @if($reserva->estado == 'Cancelado') disabled @endif>
                                        <i class="fas fa-trash"></i> Cancelar
                                    </button>
                                </td>
                                </tr>
                            @endforeach
                    </table>
                </div>
            </div>
        </div>
        <!-- Botones para volver o para hacer un pdf con las reservas del usuario -->
        <a href="{{ route('index') }}" class="btn btn-dark mt-2 mb-2">Volver</a>
        <a href="{{ route('reservas.report') }}" class="btn btn-danger mt-2 mb-2">Reporte por pdf</a>
    </div>
</body>
<script>

//Configuración global de AJAX para incluir el token CSRF en cada solicitud
//Si no, puede producir fallos
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});



// Evento para el botón Confirmar
$('.btn-confirmar').on('click', function() {
    var $button = $(this); // Guardar referencia al botón clicado
    //Obtener el id de la reserva
    var reservaId = $(this).data('id');  
    // Deshabilitar el botón inmediatamente para evitar múltiples clics
    $button.prop('disabled', true);
    
    $.ajax({
        url: '/reservas/'+reservaId+'/confirmar',
        type: 'POST',
        success: function(response) {
            if (response.success) {
                //Actualizar el estado de la reserva en la tabla
                $('tr').find('td').each(function() {

                    var td = $(this);
                    //Buscar la fila correspondiente a la reserva y cambiar su estado
                    if (td.text().trim() == reservaId) {
                        td.closest('tr').find('td:nth-child(7)').html('<span class="confirmado">Confirmado</span>');
                       
                    }
                });
                

                //Mostrar el mensaje de éxito en el div
                $('#mensajeReserva').removeClass('d-none').addClass('alert-success').html(response.success);
                
                //Para ocultar el mensaje despues de 4 segundos
                setTimeout(function() {
                $('#mensajeReserva').removeClass('alert-success').addClass('d-none');
                    }, 4000);
            } else {
                $('#mensajeReserva').removeClass('d-none').addClass('alert-danger').html('Error al confirmar la reserva.');
                setTimeout(function() {
                    $('#mensajeReserva').removeClass('alert-dange').addClass('d-none');
                    }, 4000);
            }
        },
        //Si hubo un error, mostrar mensaje de error y ocultarlo después de 4 segundos
        error: function(error) {
             $button.prop('disabled', false);
            $('#mensajeReserva')
                .removeClass('d-none alert-success')
                .addClass('alert-danger')
                .html('Hubo un error al procesar la reserva.');

            // Rehabilitar el botón si hay un error
            $button.prop('disabled', false);
            $('#mensajeReserva').removeClass('d-none').addClass('alert-danger').html("Hubo un error al procesar la reserva.");
            setTimeout(function() {
                $('#mensajeReserva').removeClass('alert-dange').addClass('d-none');
                    }, 4000);
        }
    });
});

// Evento para el botón Cancelar
$('.btn-cancelar').on('click', function() {
    var $button = $(this); // Guardar referencia al botón clicado
    var reservaId = $(this).data('id');
    
    // Deshabilitar el botón inmediatamente para evitar múltiples clics
    $button.prop('disabled', true);
    $.ajax({
        url: '/reservas/'+ reservaId+'/cancelar',
        type: 'POST',
        success: function(response) {
            if (response.success) {
                $('tr').find('td').each(function() {
                    var td = $(this);
                    if (td.text().trim() == reservaId) {
                        td.closest('tr').find('td:nth-child(7)').html('<span class="cancelado">Cancelado</span>');
                         // Asegurarse de que el botón Cancelar esté deshabilitado
                        td.closest('tr').find('.btn-cancelar').prop('disabled', true);
                    }
                });
                $('#mensajeReserva').removeClass('d-none').addClass('alert-success').html(response.success);
                setTimeout(function() {
                    $('#mensajeReserva').addClass('d-none');
                    window.location.reload();  
                    }, 4000);
            } else {
                $('#mensajeReserva').removeClass('d-none').addClass('alert-danger').html('Error al cancelar la reserva.');
                setTimeout(function() {
                    $('#mensajeReserva').addClass('d-none');  
                    }, 4000);
            }
        },
        error: function(error) {
            $('#mensajeReserva').removeClass('d-none').addClass('alert-danger').html("Hubo un error al procesar la reserva.");
            setTimeout(function() {
                $('#mensajeReserva').addClass('d-none');
                }, 4000);
        }
    });
});
</script>
@endsection

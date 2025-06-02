<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Confirmación de tu Reserva</title>
</head>
<body style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f7f7f7; padding: 30px;">
    <div style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 12px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); overflow: hidden;">
        <div style="background-color: #10b981; padding: 20px; text-align: center;">
            <h1 style="color: #ffffff; margin: 0;">Confirmación de tu Reserva</h1>
        </div>
        <div style="padding: 30px;">
            <h3 style="color: #333;">Hola {{ $reserva->usuario->name }},</h3>
            <p style="font-size: 16px; color: #555555; line-height: 1.6;">
                Tu reserva ha sido confirmada con los siguientes detalles:
            </p>
            <ul style="list-style: none; padding: 0; font-size: 16px; color: #444;">
                <li><strong>🏨 Hotel:</strong> {{ $reserva->hotel->nombre }}</li>
                <li><strong>📅 Fecha de Entrada:</strong> {{ $reserva->fecha_entrada }}</li>
                <li><strong>📆 Fecha de Salida:</strong> {{ $reserva->fecha_salida }}</li>
                <li><strong>🛏️ Número de Habitaciones:</strong> {{ $reserva->num_habitaciones }}</li>
                <li><strong>💳 Total a Pagar:</strong> €{{ number_format($reserva->total_pagar, 2) }}</li>
            </ul>
            <div style="margin-top: 30px; text-align: center;">
                <a href="{{ url('/') }}" style="display: inline-block; background-color: #10b981; color: #ffffff; padding: 12px 25px; border-radius: 8px; text-decoration: none; font-weight: bold;">
                    Ver mi reserva
                </a>
            </div>
            <p style="font-size: 14px; color: #777777; margin-top: 40px;">
                Gracias por reservar con <strong>HotelesHB</strong>. ¡Esperamos que disfrutes tu estancia!
            </p>
        </div>
        <div style="background-color: #f0f0f0; padding: 20px; text-align: center; font-size: 12px; color: #888888;">
            © {{ date('Y') }} HotelesHB. Todos los derechos reservados.
        </div>
    </div>
</body>
</html>

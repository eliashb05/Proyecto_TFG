<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bienvenido a la plataforma</title>
</head>
<body style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f4f4; padding: 30px;">
    <div style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 12px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); overflow: hidden;">
        <div style="background-color: #4f46e5; padding: 20px; text-align: center;">
            <h1 style="color: #ffffff; margin: 0;">¡Bienvenido, {{ $usuario->name }}!</h1>
        </div>
        <div style="padding: 30px;">
            <p style="font-size: 18px; color: #333333; line-height: 1.6;">
                Gracias por unirte a nuestra plataforma. Estamos encantados de tenerte con nosotros.
            </p>
            <p style="font-size: 16px; color: #555555; line-height: 1.6;">
                A partir de ahora, podrás disfrutar de los mejores precios en tus lugares favoritos.
            </p>
            <div style="margin-top: 30px; text-align: center;">
                <a href="{{ url('/') }}" style="display: inline-block; background-color: #4f46e5; color: #ffffff; padding: 12px 25px; border-radius: 8px; text-decoration: none; font-weight: bold;">
                    Ir al sitio
                </a>
            </div>
        </div>
        <div style="background-color: #f0f0f0; padding: 20px; text-align: center; font-size: 12px; color: #888888;">
            © {{ date('Y') }} HotelesHB. Todos los derechos reservados.
        </div>
    </div>
</body>
</html>

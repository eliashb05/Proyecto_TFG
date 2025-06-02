<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Política de Privacidad - HotelesHB</title>
    <link rel="icon" href="{{ asset('imagenes/favicon.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
</head>
<body style="background-color: #f8f9fa; color: #333; font-family: 'Segoe UI', sans-serif;">

    <div class="container my-5">
        <h2 class="mb-4">Política de Privacidad</h2>

        <p>En <strong>HotelesHB</strong>, nos comprometemos a proteger tu privacidad y garantizar la seguridad de tus datos personales. Esta política describe cómo recopilamos, usamos y protegemos la información que nos proporcionas al utilizar nuestro sitio web.</p>

        <h5 class="mt-4">1. Información que recopilamos</h5>
        <p>Podemos recopilar la siguiente información cuando usas nuestro sitio:</p>
        <ul>
            <li>Nombre y apellidos</li>
            <li>Dirección de correo electrónico</li>
            <li>Información de contacto</li>
            <li>Fechas de viaje y destino</li>
            <li>Preferencias de búsqueda</li>
        </ul>

        <h5 class="mt-4">2. Uso de la información</h5>
        <p>La información que recopilamos se utiliza para:</p>
        <ul>
            <li>Procesar tus búsquedas y reservas de hoteles</li>
            <li>Mejorar tu experiencia de usuario</li>
            <li>Enviarte información relevante sobre nuestros servicios (solo si lo autorizas)</li>
            <li>Cumplir con obligaciones legales</li>
        </ul>

        <h5 class="mt-4">3. Protección de datos</h5>
        <p>Implementamos medidas técnicas y organizativas adecuadas para proteger tus datos personales frente a accesos no autorizados, pérdidas o alteraciones.</p>

        <h5 class="mt-4">4. Compartición de datos</h5>
        <p>No vendemos, alquilamos ni compartimos tus datos personales con terceros, salvo que sea necesario para:</p>
        <ul>
            <li>Proveer el servicio solicitado (por ejemplo, comunicar tu reserva al hotel)</li>
            <li>Cumplir con la ley o requerimientos legales</li>
        </ul>

        <h5 class="mt-4">5. Derechos del usuario</h5>
        <p>Puedes solicitar en cualquier momento:</p>
        <ul>
            <li>Acceder a tus datos personales</li>
            <li>Modificar o eliminar tu información</li>
            <li>Retirar tu consentimiento para el uso de tus datos</li>
        </ul>
        <p>Para ejercer estos derechos, contáctanos a: <a href="mailto:soporte@hoteleshb.com">soporte@hoteleshb.com</a></p>

        <h5 class="mt-4">6. Cookies</h5>
        <p>Usamos cookies para mejorar tu experiencia en el sitio. Puedes gestionar tus preferencias de cookies desde la configuración de tu navegador.</p>

        <h5 class="mt-4">7. Cambios en esta política</h5>
        <p>Nos reservamos el derecho a modificar esta política en cualquier momento. Te notificaremos cualquier cambio importante en nuestro sitio web.</p>

        <p class="mt-5"><strong>Última actualización:</strong> 2 de junio de 2025</p>
        <p>Si tienes alguna pregunta o inquietud sobre nuestra política de privacidad, no dudes en contactarnos.</p>
        <a href="{{ url()->previous() }}" class="btn btn-outline-primary w-15">Volver</a>
    </div>

  <footer class="text-light bg-dark pt-5 pb-4">
    <div class="container text-md-left">
        <div class="row text-md-left">

            <!-- Columna 1: Marca -->
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 fw-bold">HotelesHB</h5>
                <p>Tu portal confiable para encontrar los mejores hoteles al mejor precio en todo el mundo.</p>
            </div>

            <!-- Columna 2: Enlaces -->
            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                <h6 class="text-uppercase mb-4 fw-bold">Enlaces</h6>
                <p><a href="#" class="text-light text-decoration-none">Inicio</a></p>
                <p><a href="{{ route('hoteles.index') }}" class="text-light text-decoration-none">Hoteles</a></p>
                <p><a href="{{ route('contacto.index') }}" class="text-light text-decoration-none">Contacto</a></p>
                <p><a href="{{ route('politica') }}" class="text-light text-decoration-none">Política de privacidad</a></p>
            </div>

            <!-- Columna 3: Contacto -->
            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                <h6 class="text-uppercase mb-4 fw-bold">Contacto</h6>
                <p><i class="fas fa-home me-2"></i> Calle Miguel de Cervantes 24, Albacete</p>
                <p><i class="fas fa-envelope me-2"></i> soporte@hoteleshb.com</p>
                <p><i class="fas fa-phone me-2"></i> +34 620 122 133</p>
            </div>

            <!-- Columna 4: Redes sociales -->
            <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mt-3 text-center">
                <h6 class="text-uppercase mb-4 fw-bold">Síguenos</h6>
                <a href="#" class="text-light me-3 fs-4"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="text-light me-3 fs-4"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-light me-3 fs-4"><i class="fab fa-instagram"></i></a>
                <a href="#" class="text-light fs-4"><i class="fab fa-linkedin"></i></a>
            </div>

        </div>

        <hr class="my-4">

        <div class="text-center">
            <p class="mb-0">&copy; 2025 HotelesHB. Todos los derechos reservados.</p>
        </div>
    </div>
</footer>


    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>

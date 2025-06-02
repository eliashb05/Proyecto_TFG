<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto - HotelesHB</title>
    <link rel="icon" href="{{ asset('imagenes/favicon.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f9fafb;
            font-family: 'Segoe UI', sans-serif;
            color: #333;
        }
        .contact-hero {
            background: linear-gradient(135deg, #007aff, #4a90e2);
            color: white;
            padding: 80px 0 50px;
            text-align: center;
        }
        .contact-hero h1 {
            font-size: 2.5rem;
            font-weight: 600;
        }
        .contact-form {
            background: #fff;
            margin-top: -30px;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
        }
        footer {
            background-color: #212529;
            color: white;
            padding: 30px 0;
        }
        footer a {
            color: #f8f9fa;
            margin: 0 10px;
        }
    </style>
</head>
<body>
<header class="contact-hero">
    <div class="container">
        <h1>Contáctanos</h1>
        <p>¿Tienes alguna pregunta? Estaremos encantados de ayudarte.</p>
    </div>
</header>

<div class="container contact-form">
    <!-- Mostrar mensaje de exito -->
    @if(session('mensaje'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('mensaje') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif
    <!-- Para enviar el formulario de Contacto -->
    <form action="{{ route('contacto.enviar') }}" method="POST">
        @csrf
        <div class="row g-3">
            <div class="col-md-6">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" style="border: 1px solid;" required>
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" name="email"  style="border: 1px solid;" required>
            </div>
            <div class="col-12">
                <label for="asunto" class="form-label">Asunto</label>
                <input type="text" class="form-control" id="asunto" name="asunto"  style="border: 1px solid;" required>
            </div>
            <div class="col-12">
                <label for="mensaje" class="form-label">Mensaje</label>
                <textarea class="form-control" id="mensaje" name="mensaje" rows="5"  style="border: 1px solid;" required></textarea>
            </div>
            <div class="col-12 text-end">
                <button type="submit" class="btn btn-primary px-5">Enviar</button>
                <a href="{{ route('index') }}" class="btn btn-secondary px-5">Volver</a>
            </div>
            <div class="col-11 text-end ms-2">

            </div>
        </div>
    </form>
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
        <!-- Footer sencillo -->
        <div class="text-center">
            <p class="mb-0">&copy; 2025 HotelesHB. Todos los derechos reservados.</p>
        </div>
    </div>
</footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

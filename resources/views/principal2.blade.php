<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HotelesHB - Buscar Hotel</title>
    <link rel="icon" href="{{ asset('imagenes/favicon.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f9fafb;
            font-family: 'Segoe UI', sans-serif;
            color: #333;
        }
        .hero {
            background: linear-gradient(135deg, #4a90e2, #007aff);
            color: white;
            padding: 100px 0 60px;
            text-align: center;
        }
        .hero h1 {
            font-size: 2.8rem;
            font-weight: 600;
        }
        .hero p {
            font-size: 1.1rem;
            margin-top: 10px;
        }
        .search-form {
            margin-top: -40px;
            background: #fff;
            padding: 25px;
            border-radius: 16px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
        }
        .hotel-card {
            border: none;
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.3s ease-in-out;
            box-shadow: 0 4px 14px rgba(0,0,0,0.07);
        }
        .hotel-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        }
        .hotel-location {
            font-size: 0.85rem;
            color: #6c757d;
        }
        .card-title {
            font-size: 1rem;
            font-weight: 600;
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
    @extends('layouts.navbar');
</head>
<body>
<header class="hero">
    <div class="container">
        <h1>Encuentra tu próximo destino</h1>
        <p>Explora nuestras mejores ofertas de hoteles por todo el mundo</p>
    </div>
</header>

<div class="container search-form">
    <form action="{{ route('hoteles.buscar') }}" method="POST">
        @csrf
        <div class="row g-3 align-items-end">
            <div class="col-md-4">
                <label for="destino" class="form-label">Destino</label>
                <input type="text" class="form-control" id="destino" name="destino" placeholder="Ciudad, hotel..." value="{{ old('destino') }}" required>
            </div>
            <div class="col-md-2">
                <label for="fecha_entrada" class="form-label">Entrada</label>
                <input type="date" class="form-control" id="fecha_entrada" name="fecha_entrada" value="{{ old('fecha_entrada') }}" required>
            </div>
            <div class="col-md-2">
                <label for="fecha_salida" class="form-label">Salida</label>
                <input type="date" class="form-control" id="fecha_salida" name="fecha_salida" value="{{ old('fecha_salida') }}" required>
            </div>
            <div class="col-md-2">
                <label for="huespedes" class="form-label">Huéspedes</label>
                <select class="form-select" id="huespedes" name="huespedes" required>
                    <option value="" selected disabled>Seleccionar</option>
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}">{{ $i }} huésped{{ $i > 1 ? 'es' : '' }}</option>
                    @endfor
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Buscar</button>
            </div>
        </div>
    </form>
</div>
@if (session('success'))
<div class="alert alert-success mt-3 text-center">
    {{ session('success') }}
</div>
@endif
@if ($errors->any())
    <div class="alert alert-danger mt-3">
    <strong>Se encontraron los siguientes errores:</strong>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="container my-5">
    <div class="row g-4">
        @forelse($hoteles as $hotel)
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card hotel-card">
                    <div class="badge bg-danger position-absolute top-0 end-0 m-2">
                        {{ $hotel->reservas_count ?? '0' }} reservas
                    </div>
                    <img src="{{ asset($hotel->imagen) }}" class="card-img-top" alt="{{ $hotel->nombre }}" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">{{ Str::limit($hotel->nombre, 22) }}</h5>
                        <p class="hotel-location mb-1">
                            <i class="fas fa-map-marker-alt"></i> {{ $hotel->localizacion }}
                        </p>
                        <div class="mb-2">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star {{ $i <= $hotel->valoracion ? 'text-warning' : 'text-muted' }}"></i>
                            @endfor
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold">{{ $hotel->precio }}€/noche</span>
                            <a href="{{ route('hoteles.show', $hotel->idhoteles) }}" class="btn btn-outline-primary btn-sm rounded-pill">Ver</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <h4>No se encontraron hoteles para los criterios de búsqueda.</h4>
            </div>
        @endforelse
    </div>

    <div class="text-center mt-5">
        <a href="{{ route('hoteles.index') }}" class="btn btn-primary btn-lg rounded-pill">
            <i class="fas fa-search me-2"></i> Buscar Más
        </a>
    </div>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
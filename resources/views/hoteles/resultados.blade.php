@extends('master')

@section('contenido')

<!-- Barra de navegación -->
<div class="d-flex flex-column min-vh-100">
    @include('layouts.navbar')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Contenido principal -->
    <main class="flex-grow-1 bg-light py-5" style="padding-top: 80px;">
        <!-- Muestra los hoteles encontrados con sus datos -->
        <div class="container">
            <h2 class="text-center mt-4">Resultados de la búsqueda</h2>
            <p class="text-center text-muted mb-4">Se encontraron <strong>{{ $hoteles->count() }}</strong> hoteles que coinciden con tu búsqueda.</p>
            <div class="text-center mb-4">
                <a href="{{ route('index') }}" class="btn btn-primary">
                    <i class="fas fa-arrow-left"></i> Volver a la búsqueda
                </a>
            @if($hoteles->count())
                <div class="row g-4 mt-4">
                    @foreach($hoteles as $hotel)
                    <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                        <div class="card h-100 hover-shadow">
                            <div class="badge bg-danger position-absolute top-0 end-0 m-2">
                                {{ $hotel->reservas_count ?? '0' }} reservas
                            </div>
                            <img src="{{ asset($hotel->imagen) }}" 
                                 class="card-img-top" 
                                 alt="{{ $hotel->nombre }}"
                                 loading="lazy"
                                 style="height: 180px; object-fit: cover;">
                            
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ Str::limit($hotel->nombre, 20) }}</h5>
                                <small class="text-muted mb-2">
                                    <i class="fas fa-map-marker-alt"></i> {{ $hotel->localizacion }}
                                </small>
                                
                                <div class="mt-auto">
                                    <div class="mb-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $hotel->valoracion ? 'text-warning' : 'text-secondary' }}"></i>
                                        @endfor
                                    </div>
                                    
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="h5 fw-bold mb-0">{{ $hotel->precio }}€/noche</span>
                                        <a href="{{ route('hoteles.show', $hotel->idhoteles) }}" 
                                           class="btn btn-sm btn-outline-success">
                                            Ver <i class="fas fa-chevron-right ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-warning text-center mt-5" role="alert">
                    No se encontraron hoteles que coincidan con los criterios de búsqueda.
                </div>
            @endif
        </div>
    </main>

    <!-- Pie de página -->
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
</div>
@endsection

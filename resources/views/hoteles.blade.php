@extends('master')

@section('contenido')
<!-- Agregar el CSS de Leaflet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<div id="mensajeReserva" class="alert d-none text-center"></div>

<div class="container py-5">
    <h2 class="text-center mb-4">Lista de Hoteles</h2>

    <div class="row g-4">
        @foreach($hoteles as $hotel)
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <img src="{{ asset($hotel->imagen) }}" class="card-img-top" alt="{{ $hotel->nombre }}" style="height: 180px;">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $hotel->nombre }}</h5>
                    <p class="card-text text-muted">{{ $hotel->localizacion }}</p>
                    <p class="fw-bold text-primary">{{ $hotel->precio }}€/noche</p>
                    <p class="text-warning mb-2">
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star {{ $i <= $hotel->valoracion ? '' : 'text-secondary' }}"></i>
                        @endfor
                    </p>
                    <a href="{{ route('hoteles.show', $hotel->idhoteles) }}" 
                       class="btn btn-sm btn-outline-primary">
                        Ver <i class="fas fa-chevron-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
        @endforeach


    <div class="mt-4 d-flex justify-content-center">
        {{ $hoteles->links() }}
    </div>

    <a href="{{ route('index') }}" class="btn btn-dark ms-2 mt-4" style="width: 100px;">Volver</a>
</div>

@endsection

@extends('master')

@section('contenido')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<div class="container py-5">

    <!-- Galería de imágenes -->
    <div class="row">
        <div class="col-md-8">
            <img src="{{ asset($hotel->imagen) }}" 
                 class="img-fluid rounded shadow-sm" 
                 alt="{{ $hotel->nombre }}"
                 style="height: 450px; width: 100%; object-fit: cover;">
        </div>
        <div class="col-md-4 d-flex flex-column gap-2">
            <img src="{{ asset($hotel->imagen2) }}" 
                 class="img-fluid rounded shadow-sm" 
                 alt="{{ $hotel->nombre }}">
            <img src="{{ asset($hotel->imagen3) }}" 
                 class="img-fluid rounded shadow-sm" 
                 alt="{{ $hotel->nombre }}">
        </div>
    </div>

    <!-- Info principal -->
    <div class="row mb-4">
        <div class="col-lg-8">
            <h1 class="fw-bold">{{ $hotel->nombre }}</h1>

            <!-- Ubicación -->
            <p class="text-muted">
                <i class="fas fa-map-marker-alt text-danger"></i> {{ $hotel->localizacion }}
                 <!-- Botones de mapa -->
                <div class="mt-3">
                    <button class="btn btn-outline-primary me-2" onclick="mostrarMapa()">Ver en el mapa</button>
                    <button class="btn btn-outline-danger" onclick="ocultarMapa()">Ocultar mapa</button>
                </div>

                <!-- Contenedor oculto del mapa -->
                <div id="mapaHotel" class="mt-3 rounded shadow-sm" style="height: 300px; display: none;"></div>
            </p>

            <!-- Valoración estrellas -->
            <div class="mb-3">
                @for($i = 1; $i <= 5; $i++)
                    <i class="fas fa-star {{ $i <= $hotel->valoracion ? 'text-warning' : 'text-secondary' }}"></i>
                @endfor
                <small class="ms-2">({{ $hotel->valoracion }}/5)</small>
            </div>

            <!-- Descripción real -->
            <p class="lead">
                {{ $hotel->descripcion ?? 'Descripción aún no disponible. ¡Pronto sabrás más sobre este maravilloso hotel!' }}
            </p>

            <!-- Comodidades -->
            <h4 class="fw-bold mb-3">Comodidades</h4>
            <div class="row">
                <div class="col-6 mb-2"><i class="fas fa-wifi text-success me-2"></i> Wi-Fi gratis</div>
                <div class="col-6 mb-2"><i class="fas fa-swimmer text-primary me-2"></i> Piscina</div>
                <div class="col-6 mb-2"><i class="fas fa-spa text-info me-2"></i> Spa</div>
                <div class="col-6 mb-2"><i class="fas fa-utensils text-warning me-2"></i> Restaurante</div>
                <div class="col-6 mb-2"><i class="fas fa-dumbbell text-danger me-2"></i> Gimnasio</div>
                <div class="col-6 mb-2"><i class="fas fa-car text-secondary me-2"></i> Parking gratuito</div>
            </div>

            <!-- Reseñas -->
            <h4 class="fw-bold my-4">Opiniones de huéspedes</h4>
            <div class="border rounded p-3 mb-3 shadow-sm">
                <p><strong>María G.</strong> <small class="text-muted">- "¡Todo fue increíble!"</small></p>
                <p><i class="fas fa-quote-left me-2"></i> El hotel superó mis expectativas, muy limpio y bien ubicado. Volveré sin duda.</p>
            </div>

            <div class="border rounded p-3 shadow-sm">
                <p><strong>Javier M.</strong> <small class="text-muted">- "Buen servicio"</small></p>
                <p><i class="fas fa-quote-left me-2"></i> Personal amable, habitaciones cómodas y desayuno excelente.</p>
            </div>

            <a href="{{ route('index') }}" class="btn btn-outline-secondary mt-4">
                <i class="fas fa-arrow-left me-1"></i> Volver a Principal
            </a>
        </div>

        <!-- Comprobar errores -->
        <div class="col-lg-4">
            <div class="card shadow p-4">
                <h4 class="fw-bold text-center text-success">{{ $hotel->precio }}€ / noche</h4>
                @if ($errors->any())
                    <div class="alert alert-danger mb-4">
                        <strong>Se encontraron los siguientes errores:</strong>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Reservar -->
                <form action="{{ route('reservas.store') }}" method="POST" class="mt-3">
                    @csrf
                    <input type="hidden" name="idhotel" value="{{ $hotel->idhoteles }}">
                    <input type="hidden" name="id" value="{{ Auth::id() }}">

                    <div class="mb-3">
                        <label for="checkin" class="form-label">Fecha de entrada</label>
                        <input type="date" name="fecha_entrada" id="checkin" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="checkout" class="form-label">Fecha de salida</label>
                        <input type="date" name="fecha_salida" id="checkout" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="numHabitaciones" class="form-label">Número de habitaciones</label>
                        <input type="number" class="form-control" name="num_habitaciones" id="numHabitaciones" min="1" max="{{ $hotel->habitaciones }}" value="1" required>
                    </div>

                    <!-- Campo oculto para enviar al backend -->
                    <input type="hidden" name="total_pagar" id="totalPagar">

                    <!-- Visualización del total -->
                    <div class="mb-3">
                        <label class="form-label">Precio total:</label>
                        <div class="alert alert-info" id="precioTotalVisible">Selecciona fechas</div>
                    </div>

                    <button type="submit" class="btn btn-success w-100">Reservar Ahora</button>
                </form>
                <hr class="my-4">

                <!-- Simulación disponibilidad -->
                <h6 class="text-center">¡Solo quedan {{ $hotel->habitaciones }} habitaciones en nuestra web!</h6>
                <div class="progress" style="height: 10px;">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>

</div>
<script>

const precioPorNoche = {{ $hotel->precio }};

function calcularTotal() {
    const checkin = document.getElementById("checkin").value;
    const checkout = document.getElementById("checkout").value;
    const numHabitaciones = parseInt(document.getElementById("numHabitaciones").value);

    if (checkin && checkout && numHabitaciones) {
        const fechaEntrada = new Date(checkin);
        const fechaSalida = new Date(checkout);

        const diferenciaTiempo = fechaSalida - fechaEntrada;
        const dias = diferenciaTiempo / (1000 * 3600 * 24);

        if (dias > 0) {
            const total = dias * precioPorNoche * numHabitaciones;
            document.getElementById("totalPagar").value = total.toFixed(2);
            document.getElementById("precioTotalVisible").innerText = total.toFixed(2) + " €";
        } else {
            document.getElementById("totalPagar").value = '';
            document.getElementById("precioTotalVisible").innerText = "Selecciona fechas válidas";
        }
    } else {
        document.getElementById("precioTotalVisible").innerText = "Selecciona fechas";
    }
}

document.getElementById("checkin").addEventListener("change", calcularTotal);
document.getElementById("checkout").addEventListener("change", calcularTotal);
document.getElementById("numHabitaciones").addEventListener("change", calcularTotal);

function mostrarMapa() {
        const contenedor = document.getElementById('mapaHotel');
        contenedor.style.display = 'block';

        // Solo inicializamos una vez
        if (!window.mapaIniciado) {
            const lat = {{ $hotel->latitud }};
            const lng = {{ $hotel->longitud }};

            const mapa = L.map('mapaHotel').setView([lat, lng], 15);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(mapa);

            L.marker([lat, lng]).addTo(mapa)
                .bindPopup("{{ $hotel->nombre }}")
                .openPopup();

            window.mapaIniciado = true;
        }
    }
    function ocultarMapa() {
    document.getElementById('mapaHotel').style.display = 'none';
}
</script>
@endsection

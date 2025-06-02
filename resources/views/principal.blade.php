<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>HotelesHB - Reserva con estilo</title>
	<link rel="icon" href="{{ asset('/imagenes/favicon.png') }}" type="image/png">
	
	<!-- Bootstrap -->
	<link href="{{ url('bootstrap/bootstrap.min.css') }}" rel="stylesheet">
	<script src="{{ url('bootstrap/bootstrap.bundle.min.js') }}"></script>

	<!-- FontAwesome -->
	<link href="ficheros/all.css" rel="stylesheet">

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">

	<style>
		:root {
			--color-primario: #00b4d8;
			--azul-oscuro: #03045e;
			--efecto-transparente: rgba(255, 255, 255, 0.1);
			--brillo: blur(10px);
		}

		* {
			box-sizing: border-box;
		}

		body {
			margin: 0;
			font-family: 'Poppins', sans-serif;
			color: #fff;
			background: #000;
			overflow-x: hidden;
		}

		.hero {
			background: url('/imagenes/fondo.jpg') no-repeat center center/cover;
			height: 100vh;
			position: relative;
			display: flex;
			flex-direction: column;
			justify-content: center;
			align-items: center;
			text-align: center;
			z-index: 1;
		}

		.hero::after {
			content: '';
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background: rgba(0, 0, 0, 0.6);
			backdrop-filter: blur(2px);
			z-index: -1;
		}

		.hero h1 {
			font-size: 3rem;
			font-weight: 700;
			margin-bottom: 1rem;
			color: #fff;
			text-shadow: 2px 2px 10px rgba(0,0,0,0.7);
		}

		.hero p {
			font-size: 1.2rem;
			font-weight: 300;
			margin-bottom: 2rem;
			max-width: 600px;
		}

		.btn-glass {
			border: none;
			padding: 0.8rem 2rem;
			margin: 0 0.5rem;
			border-radius: 50px;
			font-weight: 500;
			color: #fff;
			background: var(--efecto-transparente);
			backdrop-filter: var(--brillo);
			box-shadow: 0 8px 32px rgba(0, 0, 0, 0.37);
			transition: all 0.3s ease-in-out;
			text-decoration: none;
		}

		.btn-glass:hover {
			transform: scale(1.05);
			background: var(--color-primario);
			color: #000;
		}

		.navbar {
			position: absolute;
			top: 20px;
			right: 40px;
			z-index: 2;
		}

		footer {
			background: #0a0a0a;
			color: #ccc;
			padding: 20px 0;
			text-align: center;
			font-size: 0.9rem;
			box-shadow: 0 -2px 10px rgba(0,0,0,0.2);
		}

		footer i {
			color: #ffd60a;
		}

		@media (max-width: 768px) {
			.hero h1 {
				font-size: 2.2rem;
			}
			.hero p {
				font-size: 1rem;
			}
			.navbar {
				right: 20px;
			}
		}
	</style>
</head>
<body>

	<!-- NAVBAR -->
	<div class="navbar">
		<!-- Si ya tiene la sesión iniciada "Ir al panel" -->
		@if (Route::has('login'))
			@auth
				<a href="{{ url('principal2') }}" class="btn-glass">Ir al Panel</a>
			@else
				<a href="{{ route('login') }}" class="btn-glass">Iniciar sesión</a>
				@if (Route::has('register'))
					<a href="{{ route('register') }}" class="btn-glass">Registro</a>
				@endif
			@endauth
		@endif
	</div>

	<!-- HERO -->
	<section class="hero">
		<h1>Descubre tu próxima escapada</h1>
		<p>Hoteles de ensueño al mejor precio. Reserva ahora y vive la experiencia con HotelesHB.</p>
	</section>


</body>
</html>

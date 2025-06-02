<!DOCTYPE html>
<html lang="es">
<html>
<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>HotelesHB</title>
		<link rel="icon" type="image/png" href="{{ asset('/imagenes/favicon.png') }}">
	<!-- estilo general de la página -->
		<link href="ficheros/estilo_pagina.css" rel="stylesheet">

		<!-- estilo barra de menú -->
		<link href="ficheros/barra_menu.css" rel="stylesheet">		

		<!-- estilo de formularios -->
		<link href="ficheros/formularios.css" rel="stylesheet">

		<!-- estilo de tablas -->
		<!-- <link href="ficheros/tablas.css" rel="stylesheet"> -->
		<!-- biblioteca de iconos -->
		<link href="ficheros/all.css" rel="stylesheet">	

		<!-- Bootstrap CSS-JS -->
		<link href="{{ url('bootstrap/bootstrap.min.css') }}" rel="stylesheet">
		<script src="{{ url('bootstrap/bootstrap.bundle.min.js') }}"></script>

		<!-- jQuery -->
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<!-- arreglo particular CSS -->
@yield('css')

<body class="d-flex flex-column" style="height: 250px;">
				@yield('contenido')
</body>
</html>

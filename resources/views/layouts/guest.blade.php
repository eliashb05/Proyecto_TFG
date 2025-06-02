<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <link rel="icon" type="image/png" href="{{ asset('/imagenes/favicon.png') }}">
        <title>{{ config('app.name', 'HotelesHB') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Estilos personalizados -->
        <style>
         body {
    background-color: #f4f4f4;
    font-family: 'Arial', sans-serif;
}

/* Contenedor del formulario */
.login-container {
    width: 100%;
    max-width: 400px;
    margin: 20px auto;
    padding: 30px;
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* Títulos */
h2 {
    color: #333333;
    font-size: 24px;
    margin-bottom: 20px;
}

/* Campos de entrada */
input[type="text"],
input[type="email"],
input[type="password"] {
    width: 100%;
    padding: 12px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    font-size: 16px;
}

/* Botón de envío */
button[type="submit"] {
    width: 100%;
    padding: 12px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
}

button[type="submit"]:hover {
    background-color: #0056b3;
}

/* Enlaces */
a {
    text-decoration: none;
    font-size: 14px;
}

a:hover {
    text-decoration: underline;
}
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            <!-- Contenedor del formulario de login con la clase 'login-container' -->
            <div class="login-container">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>

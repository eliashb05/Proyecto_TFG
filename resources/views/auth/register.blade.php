<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>HotelesHB - Registro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('imagenes/favicon.png') }}" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(to bottom right, #a8dadc, #457b9d);
            font-family: 'Segoe UI', sans-serif;
        }

        .register-card {
            background-color: #ffffff;
            padding: 2.5rem;
            border-radius: 1rem;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 550px;
        }

        .form-label {
            font-weight: bold;
            color: #1d3557;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(69, 123, 157, 0.25);
            border-color: #457b9d;
        }

        .btn-animated {
            transition: all 0.3s ease-in-out;
        }

        .btn-animated:hover {
            transform: scale(1.05);
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.2);
        }

        .extra-links a {
            text-decoration: none;
            font-weight: bold;
        }

        .extra-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="register-card">
    <h2 class="text-center mb-4 text-dark">Crear cuenta</h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Nombre -->
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Contraseña -->
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input id="password" type="password" class="form-control" name="password" required>
            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Confirmar contraseña -->
        <div class="mb-4">
            <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
            @error('password_confirmation')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Botón registrar -->
        <div class="d-grid mb-3">
            <button type="submit" class="btn btn-primary btn-animated">
                Registrarse
            </button>
        </div>

        <!-- Enlaces -->
        <div class="text-center extra-links">
            <a href="{{ route('login') }}" class="text-dark d-block mb-2">¿Ya tienes cuenta? Inicia sesión</a>
            <a href="{{ url('/') }}" class="text-dark">← Volver</a>
        </div>
    </form>
</div>

</body>
</html>

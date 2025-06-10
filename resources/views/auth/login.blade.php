<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>HotelesHB - Login</title>
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

        .login-card {
            background-color: #ffffff;
            padding: 2.5rem;
            border-radius: 1rem;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 500px;
        }

        .btn-animated {
            transition: all 0.3s ease-in-out;
        }

        .btn-animated:hover {
            transform: scale(1.05);
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.2);
        }

        .form-label {
            font-weight: bold;
            color: #1d3557;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(69, 123, 157, 0.25);
            border-color: #457b9d;
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

<div class="login-card">
    <h2 class="text-center mb-4 text-dark">Iniciar sesión</h2>

    @if (session('status'))
        <div class="alert alert-success text-sm text-center">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="Correo electrónico">
            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña:</label>
            <input id="password" type="password" class="form-control" name="password" required placeholder="Contraseña">
            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="form-check mb-3">
            <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
            <label for="remember_me" class="form-check-label text-muted">
                {{ __('Recuérdame') }}
            </label>
        </div>

        <!-- Botón Login -->
        <div class="d-grid mb-3">
            <button type="submit" class="btn btn-success btn-animated">
                {{ __('Entrar') }}
            </button>
        </div>

        <!-- Enlaces de ayuda -->
        <div class="text-center extra-links mb-2">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-dark d-block mb-2">
                    ¿Olvidaste tu contraseña?
                </a>
            @endif

            <a href="{{ route('register') }}" class="text-dark d-block mb-2">
                ¿No tienes cuenta? Regístrate
            </a>

            <a href="{{ url('/') }}" class="text-dark">
                ← Volver
            </a>
        </div>
    </form>
</div>

</body>
</html>

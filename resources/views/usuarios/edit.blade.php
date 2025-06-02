@extends('master')

@section('contenido')
<div class="d-flex flex-column min-vh-100">
    <!-- Incluir la misma barra de navegación -->
    @include('layouts.navbar')

    <!-- Contenido principal -->
    <main class="flex-grow-1 bg-light py-5" style="padding-top: 80px;">
        <div class="container-fluid py-5">
            <h2 class="mb-3 text-center">Editar Usuario</h2>
            <p class="text-muted text-center mb-5">Modifica los detalles del usuario</p>

            <!-- Mensajes de éxito o error -->
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card shadow-sm mx-auto" style="max-width: 600px;">
                <div class="card-body">
                    <!-- Formulario para actualizar el usuario -->
                    <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $usuario->name) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $usuario->email) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="rol" class="form-label">Rol</label>
                            <select class="form-select" id="rol" name="rol" required>
                                <option value="admin" {{ $usuario->rol === 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="user" {{ $usuario->rol === 'user' ? 'selected' : '' }}>User</option>
                            </select>
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <!-- Incluir el pie de página -->
    @include('layouts.footer')
</div>
@endsection
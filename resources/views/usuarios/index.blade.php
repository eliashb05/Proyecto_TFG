@extends('master')

@section('contenido')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<div class="d-flex flex-column min-vh-100">
    <!-- Incluir la misma barra de navegación -->
    @include('layouts.navbar')

    <!-- Contenido principal -->
    <main class="flex-grow-1 bg-light py-5" style="padding-top: 80px;">
        <div class="container-fluid py-5">
            <h2 class="mb-3 text-center">Gestión de Usuarios</h2>
            <p class="text-muted text-center mb-5">Administra los usuarios del sistema</p>

            <!-- Mensajes de éxito o error -->
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="card shadow-sm">
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Rol</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($usuarios as $usuario)
                            <tr>
                                <td>{{ $usuario->name }}</td>
                                <td>{{ $usuario->email }}</td>
                                <td>{{ $usuario->rol }}</td>
                                <td>
                                      <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                    <!-- Eliminar usuario siempre que no sea el mismo -->
                                    @if(auth()->id() != $usuario->id)
                                    <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
                                            <i class="fas fa-trash"></i> Eliminar
                                        </button>
                                    </form>
                                    @endif
                                    <!-- Bloquear/desbloquear usuario segun el estado en el que este -->
                                    @if($usuario->bloqueado && auth()->id() != $usuario->id)
                                            <form action="{{ route('usuarios.desbloquear', $usuario->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-outline-success">
                                                    <i class="fa-solid fa-lock-open me-1"></i>Desbloquear
                                                </button>
                                            </form>
                                        @elseif ( auth()->id() != $usuario->id)
                                            <form action="{{ route('usuarios.bloquear', $usuario->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-outline-warning">
                                                    <i class="fa-solid fa-lock me-1"></i>Bloquear
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                      <a href="{{ route('index') }}" class="btn btn-dark ms-2 mt-4" style="width: 100px;">Volver</a>
                </div>
            </div>
        </div>
    </main>

    <!-- Incluir el pie de página -->
    @include('layouts.footer')
</div>
@endsection
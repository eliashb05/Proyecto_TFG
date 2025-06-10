
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm fixed-top">
    <div class="container-fluid px-4">
        <a class="navbar-brand fw-bold fs-4 d-flex align-items-center" href="{{ route('index') }}">
            HotelesHB
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a href="{{ route('hoteles.index') }}" class="nav-link active" aria-current="page">
                        <i class="fas fa-hotel me-1"></i>
                        Hoteles
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('reservas.index') }}" class="nav-link active" aria-current="page">
                        <i class="fas fa-clock me-1"></i>
                        Reservas
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('contacto.index') }}" class="nav-link active" aria-current="page">
                       <i class="fa-solid fa-address-card"></i>
                       Contacto 
                    </a>
                </li>
                @if(Auth::check() && Auth::user()->rol === 'admin')
                <li class="nav-item">
                    <a href="{{ route('usuarios.index') }}" class="nav-link active" aria-current="page">
                        <i class="fas fa-users me-1"></i>
                        Gestión de Usuarios
                    </a>
                </li>
                @endif
            </ul>
            <div class="d-flex align-items-center gap-3">
                <div class="dropdown">
                    <a class="btn btn-link text-decoration-none text-white dropdown-toggle d-flex align-items-center" 
                       href="#" role="button" data-bs-toggle="dropdown">
                        <div class="position-relative">
                            <img src="https://cdn-icons-png.flaticon.com/512/456/456212.png" 
                                 alt="User" 
                                 class="rounded-circle me-2" 
                                 style="width: 35px; height: 35px;">
                            <span class="position-absolute bottom-0 end-0 p-1 bg-success border border-2 border-white rounded-circle"></span>
                        </div>
                        <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('profile', ['id' => Auth::id()]) }}">
                            <i class="fas fa-user-circle me-2"></i>Mi perfil
                        </a></li>
                        <li><a class="dropdown-item" href="{{ route('reservas.index') }}">
                            <i class="fas fa-clock me-2"></i>Reservas
                        </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="fas fa-sign-out-alt me-2"></i>Cerrar sesión
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
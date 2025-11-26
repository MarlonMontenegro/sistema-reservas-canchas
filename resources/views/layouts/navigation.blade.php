<nav class="navbar navbar-expand-lg bg-white py-3 shadow-sm">
    <div class="container">

        {{-- Logo + nombre --}}
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ url('/') }}">
            <img src="/tu-logo.png" alt="Logo" style="width: 32px; height: 32px;">
            <span class="fw-semibold" style="font-size: 1.1rem;">FutbolHub</span>
        </a>

        {{-- Botón móvil --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#mainNavbar" aria-controls="mainNavbar"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Menú derecha --}}
        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav ms-auto align-items-center">

                {{-- Link normal --}}
                <li class="nav-item">
                    <a class="nav-link fw-medium {{ request()->is('login') ? 'active' : '' }}"
                       href="{{ route('login') }}">
                        Iniciar sesión
                    </a>
                </li>

                {{-- Botón verde --}}
                <li class="nav-item ms-2">
                    <a href="{{ route('register') }}"
                       class="btn btn-success px-4 py-2 fw-semibold"
                       style="border-radius: 10px; background-color: #054d1c;">
                        Crear cuenta
                    </a>
                </li>

            </ul>
        </div>

    </div>
</nav>

<x-guest-layout>
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-dark text-white text-center py-3 fw-bold rounded-top-4 fs-5" style="border-bottom: 4px solid #28a745;">
            <i class="bi bi-person-plus me-2"></i> REGISTRO DE ESPECTADOR
        </div>
        <div class="card-body p-4">

            @if ($errors->any())
                <div class="alert alert-danger py-2 small">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label fw-bold small text-secondary">Nombre de Usuario</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="bi bi-person"></i></span>
                        <input id="name" type="text" name="name" class="form-control" value="{{ old('name') }}" required autofocus autocomplete="name">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label fw-bold small text-secondary">Correo Electrónico</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="bi bi-envelope"></i></span>
                        <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" required autocomplete="username">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label fw-bold small text-secondary">Contraseña</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="bi bi-lock"></i></span>
                        <input id="password" type="password" name="password" class="form-control" required autocomplete="new-password">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label fw-bold small text-secondary">Confirmar Contraseña</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="bi bi-lock-fill"></i></span>
                        <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" required autocomplete="new-password">
                    </div>
                </div>

                <button type="submit" class="btn btn-success w-100 fw-bold py-2 rounded-pill shadow-sm mt-3">
                    CREAR MI CUENTA
                </button>

                <hr class="my-4">

                <div class="text-center">
                    <p class="small text-muted mb-0">¿Ya estás registrado? 
                        <a href="{{ route('login') }}" class="text-success fw-bold text-decoration-none">Inicia sesión</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
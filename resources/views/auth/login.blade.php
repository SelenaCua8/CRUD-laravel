<x-guest-layout>
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-success text-white text-center py-3 fw-bold rounded-top-4 fs-5">
            <i class="bi bi-box-arrow-in-right me-2"></i> INICIAR SESIÓN
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

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label fw-bold small text-secondary">Correo Electrónico</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="bi bi-envelope"></i></span>
                        <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus autocomplete="username">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label fw-bold small text-secondary">Contraseña</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="bi bi-lock"></i></span>
                        <input id="password" type="password" name="password" class="form-control" required autocomplete="current-password">
                    </div>
                </div>

                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" id="remember_me" name="remember">
                    <label class="form-check-label small text-muted" for="remember_me">
                        Recordarme en este dispositivo
                    </label>
                </div>

                <button type="submit" class="btn btn-success w-100 fw-bold py-2 rounded-pill shadow-sm">
                    INGRESAR
                </button>

                <hr class="my-4">

                <div class="text-center">
                    <p class="small text-muted mb-0">¿No tienes cuenta? 
                        <a href="{{ route('register') }}" class="text-success fw-bold text-decoration-none">Registrate acá</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
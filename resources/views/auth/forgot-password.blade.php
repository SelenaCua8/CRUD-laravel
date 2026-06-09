<x-guest-layout>
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-dark text-white text-center py-3 fw-bold rounded-top-4 fs-5" style="border-bottom: 4px solid #ffc107;">
            <i class="bi bi-question-circle me-2"></i> ¿OLVIDASTE TU CONTRASEÑA?
        </div>
        <div class="card-body p-4">
            
            <p class="text-secondary small mb-4">
                {{ __('¿Olvidaste tu contraseña? No hay problema. Solo dinos tu dirección de correo electrónico y te enviaremos un enlace para restablecerla que te permitirá elegir una nueva.') }}
            </p>

            @if (session('status'))
                <div class="alert alert-success py-2 small mb-4 fw-medium">
                    <i class="bi bi-check-circle-fill me-1"></i>
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger py-2 small mb-4">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="mb-4">
                    <label for="email" class="form-label fw-bold small text-secondary">Correo Electrónico</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="bi bi-envelope"></i></span>
                        <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus placeholder="tu-email@ejemplo.com">
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('login') }}" class="small text-muted text-decoration-none fw-bold">
                        <i class="bi bi-arrow-left"></i> Volver al Login
                    </a>
                    <button type="submit" class="btn btn-warning fw-bold py-2 px-4 rounded-pill shadow-sm text-dark">
                        {{ __('Enviar Enlace') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
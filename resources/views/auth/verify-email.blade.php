<x-guest-layout>
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-dark text-white text-center py-3 fw-bold rounded-top-4 fs-5" style="border-bottom: 4px solid #28a745;">
            <i class="bi bi-envelope-check me-2"></i> VERIFICACIÓN DE CORREO
        </div>
        <div class="card-body p-4">
            
            <p class="text-secondary small mb-4">
                {{ __('¡Gracias por registrarte! Antes de empezar, ¿podrías verificar tu dirección de correo haciendo clic en el enlace que te acabamos de enviar? Si no lo recibiste, con gusto te enviaremos otro.') }}
            </p>

            @if (session('status') == 'verification-link-sent')
                <div class="alert alert-success py-2 small mb-4 fw-medium">
                    <i class="bi bi-check-circle-fill me-1"></i>
                    {{ __('Se ha enviado un nuevo enlace de verificación a la dirección de correo que proporcionaste durante el registro.') }}
                </div>
            @endif

            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center gap-3 mt-4">
                <form method="POST" action="{{ route('verification.send') }}" class="w-100 w-sm-auto">
                    @csrf
                    <button type="submit" class="btn btn-success btn-sm w-100 fw-bold rounded-pill px-3 py-2 shadow-sm">
                        <i class="bi bi-arrow-clockwise me-1"></i> {{ __('Reenviar Correo') }}
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}" class="w-100 w-sm-auto text-center">
                    @csrf
                    <button type="submit" class="btn btn-link btn-sm text-muted text-decoration-none fw-bold small">
                        <i class="bi bi-box-arrow-left me-1"></i> {{ __('Cerrar Sesión') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
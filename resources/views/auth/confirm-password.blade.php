<x-guest-layout>
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-dark text-white text-center py-3 fw-bold rounded-top-4 fs-5" style="border-bottom: 4px solid #dc3545;">
            <i class="bi bi-shield-lock me-2"></i> CONFIRMAR CONTRASEÑA
        </div>
        <div class="card-body p-4">
            
            <p class="text-secondary small mb-4">
                {{ __('Esta es un área segura de la aplicación. Por favor, confirma tu contraseña antes de continuar.') }}
            </p>

            @if ($errors->any())
                <div class="alert alert-danger py-2 small mb-4">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <div class="mb-4">
                    <label for="password" class="form-label fw-bold small text-secondary">Contraseña Actual</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="bi bi-key-fill"></i></span>
                        <input id="password" type="password" name="password" class="form-control" required autocomplete="current-password" placeholder="Ingresa tu contraseña">
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-danger fw-bold py-2 px-4 rounded-pill shadow-sm text-uppercase">
                        {{ __('Confirmar') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
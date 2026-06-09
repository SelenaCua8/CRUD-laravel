<x-guest-layout>
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-dark text-white text-center py-3 fw-bold rounded-top-4 fs-5" style="border-bottom: 4px solid #dc3545;">
            <i class="bi bi-shield-key me-2"></i> REESTABLECER CONTRASEÑA
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

            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="mb-3">
                    <label for="email" class="form-label fw-bold small text-secondary">Correo Electrónico</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="bi bi-envelope"></i></span>
                        <input id="email" type="email" name="email" class="form-control" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label fw-bold small text-secondary">Nueva Contraseña</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="bi bi-lock"></i></span>
                        <input id="password" type="password" name="password" class="form-control" required autocomplete="new-password">
                    </div>
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="form-label fw-bold small text-secondary">Confirmar Nueva Contraseña</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="bi bi-lock-fill"></i></span>
                        <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" required autocomplete="new-password">
                    </div>
                </div>

                <button type="submit" class="btn btn-danger w-100 fw-bold py-2 rounded-pill shadow-sm text-uppercase">
                    Actualizar Contraseña
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>
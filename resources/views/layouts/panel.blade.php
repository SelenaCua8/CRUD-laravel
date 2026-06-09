<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mundial 360 - @yield('titulo')</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    @yield('sidebar')

    <div class="content">
        
        <div class="card border-0 shadow-sm mb-4 rounded-3">
            <div class="card-body d-flex justify-content-between align-items-center py-2 px-3">
                <h5 class="m-0 fw-bold text-secondary">
                    <i class="bi bi-speedometer2 me-2"></i> Panel de Control
                </h5>
                <div class="d-flex align-items-center gap-3">
                    <span class="fw-semibold text-dark">{{ Auth::user()->name }}</span>
                   <!-- <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill fw-bold">
                            <i class="bi bi-box-arrow-right"></i> Salir
                        </button>
                    </form>-->
                    <a href="#" class="btn btn-outline-danger btn-sm rounded-pill fw-bold">
    <i class="bi bi-box-arrow-right"></i> Salir
</a>
                </div>
            </div>
        </div>

        @yield('contenido')

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
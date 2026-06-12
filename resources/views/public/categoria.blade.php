<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <title>Categoría: {{ $categoria->nombre }} - Mundial 360</title>
</head>
<body class="bg-light">
    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-dark"><i class="bi bi-tags text-success me-2"></i> Notas de: {{ $categoria->nombre }}</h2>
            <a href="/" class="btn btn-sm btn-outline-secondary rounded-pill"><i class="bi bi-house"></i> Inicio</a>
        </div>

        <div class="row g-4">
            @forelse($posts as $post)
            <div class="col-md-6">
                <div class="card border-0 shadow-sm rounded-3 overflow-hidden bg-white h-100">
                    <div class="card-body">
                        <h4 class="fw-bold text-dark">{{ $post->titulo }}</h4>
                        <p class="text-muted small mb-3">Publicado el {{ $post->created_at->format('d/m/Y') }}</p>
                        <a href="{{ route('public.detalle', $post->id) }}" class="btn btn-sm btn-success rounded-pill">Leer Artículo Completo</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted fs-5">No hay ninguna publicación cargada bajo esta categoría todavía.</p>
            </div>
            @endforelse
        </div>
    </div>
</body>
</html>
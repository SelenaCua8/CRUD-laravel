<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <title>{{ $post->titulo }} - Mundial 360</title>
</head>
<body class="bg-light">
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="/" class="btn btn-sm btn-outline-secondary mb-4 rounded-pill"><i class="bi bi-arrow-left"></i> Volver al Inicio</a>
                
                <div class="card border-0 shadow-sm rounded-3 p-4 bg-white">
                    <span class="badge bg-success mb-2 align-self-start">ID Categoría: {{ $post->category_id }}</span>
                    <h1 class="fw-bold text-dark display-5 mb-3">{{ $post->titulo }}</h1>
                    <p class="text-muted small">Publicado el {{ $post->created_at->format('d/m/Y H:i') }}</p>
                    <hr>
                    <img src="{{ $post->imagen_url }}" class="img-fluid rounded-3 mb-4 w-100" style="max-height: 400px; object-fit: cover;">
                    <p class="fs-5 text-secondary" style="line-height: 1.8; text-align: justify;">
                        {{ $post->contenido }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
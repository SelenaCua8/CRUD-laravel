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
                <hr class="my-5">

<div class="row justify-content-center mb-5">
    <div class="col-md-8">
        <h4 class="fw-bold mb-4"><i class="bi bi-chat-left-text-fill text-success me-2"></i> Comentarios ({{ count($comentarios) }})</h4>

        @auth
            <div class="card p-3 shadow-sm border-0 bg-light mb-4 rounded-3">
                <form action="{{ route('comments.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <div class="mb-2">
                        <label class="form-label small fw-bold text-muted">Compartí tu opinión, {{ auth()->user()->name }}</label>
                        <textarea name="contenido" class="form-control" rows="3" required placeholder="¿Qué te pareció la crónica? Debatí con respeto..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-success btn-sm px-4 rounded-pill fw-bold">Publicar Comentario</button>
                </form>
            </div>
        @else
            <div class="alert alert-warning text-center small rounded-3" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> Debés <a href="{{ route('login') }}" class="fw-bold text-dark text-decoration-underline">iniciar sesión</a> para poder dejar un comentario en la tribuna.
            </div>
        @endauth

        <div class="d-flex flex-column gap-3">
            @forelse($comentarios as $com)
                <div class="card p-3 shadow-sm border-0 bg-white rounded-3">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="fw-bold text-dark"><i class="bi bi-person-circle text-secondary me-1"></i> {{ $com->nombre_usuario }}</span>
                        <span class="text-muted small"><i class="bi bi-clock me-1"></i> {{ \Carbon\Carbon::parse($com->created_at)->format('d/m/Y H:i') }}</span>
                    </div>
                    <p class="m-0 text-secondary fst-italic">"{{ $com->contenido }}"</p>
                </div>
            @empty
                <p class="text-muted text-center py-3 small">Nadie comentó esta crónica todavía. ¡Sé el primero en dejar tu opinión!</p>
            @endforelse
        </div>
    </div>
</div>
            </div>
        </div>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mundial 360 - El Templo del Fútbol</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #f4f7f6; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .navbar-futbol { background-color: #0b3c1b; } /* Verde Césped Oscuro */
        .hero-section { background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.8)), url('https://images.unsplash.com/photo-1508096682722-e99c43a406b2?w=1200') no-repeat center center/cover; color: white; padding: 60px 0; }
        .card-post { border: none; border-radius: 12px; transition: transform 0.2s; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .card-post:hover { transform: translateY(-5px); }
        .badge-futbol { background-color: #198754; }
        .fixture-header { background-color: #0d2315; color: #fff; font-weight: bold; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-futbol shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold fs-3 text-warning" href="/"><i class="bi bi-trophy-fill me-2"></i>MUNDIAL 360</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-span"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active text-white fw-semibold" href="/">Inicio</a></li>
                    @foreach($categorias as $cat)
                        <li class="nav-item">
                            <a class="nav-link text-light-50" href="{{ route('public.categoria', $cat->id) }}">{{ $cat->name }}</a>
                        </li>
                    @endforeach
                </ul>
                
                <div class="d-flex gap-2">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn btn-warning rounded-pill px-4 fw-bold shadow-sm"><i class="bi bi-speedometer2 me-1"></i> Ir a mi Panel</a>
                            <form method="POST" action="{{ route('logout') }}" class="m-0">
                                @csrf
                                <button type="submit" class="btn btn-outline-light rounded-pill"><i class="bi bi-box-arrow-right"></i></button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-light rounded-pill px-3">Ingresar</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-warning rounded-pill px-3 fw-bold text-dark">Registrarse</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <header class="hero-section text-center mb-5">
        <div class="container py-3">
            <span class="badge bg-warning text-dark fw-bold mb-2 px-3 py-2 rounded-pill text-uppercase tracking-wider">Información al Instante</span>
            <h1 class="display-4 fw-extrabold mb-3">Pasión, Crónicas y el Minuto a Minuto del Fútbol Mundial</h1>
            <p class="lead text-white-50 max-w-2xl mx-auto">Análisis tácticos, mercado de pases, resultados en vivo y todo el color de las ligas más importantes del planeta.</p>
        </div>
    </header>

    <div class="container mb-5">
        <div class="row g-4">
            
            <div class="col-lg-8">
                <h3 class="fw-bold text-dark mb-4"><i class="bi bi-newspaper text-success me-2"></i>Últimas Crónicas Publicadas</h3>
                
                <div class="row g-4">
                    @forelse($posts as $post)
                    <div class="col-md-6">
                        <div class="card card-post h-100 overflow-hidden bg-white">
                            <img src="{{ $post->imagen_url }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Imagen Nota">
                            <div class="card-body d-flex flex-direction-column justify-content-between">
                                <div>
                                    <span class="badge badge-futbol mb-2">Categoría ID: {{ $post->category_id }}</span>
                                    <h5 class="card-title fw-bold text-dark text-line-2">{{ $post->titulo }}</h5>
                                    <p class="card-text text-muted small text-line-3">{{ Str::limit($post->contenido, 110) }}</p>
                                </div>
                                <div class="mt-3 pt-3 border-top w-100 d-flex justify-content-between align-items-center">
                                    <span class="small text-muted"><i class="bi bi-calendar3 me-1"></i> {{ $post->created_at->format('d/m/Y') }}</span>
                                    <a href="{{ route('public.detalle', $post->id) }}" class="btn btn-sm btn-success rounded-pill px-3 fw-bold">Leer Nota</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12">
                        <div class="p-5 text-center bg-white rounded-3 shadow-sm border">
                            <i class="bi bi-emoji-frown display-3 text-muted mb-3"></i>
                            <h5>No hay publicaciones disponibles en este momento</h5>
                            <p class="text-muted">Ingresá como Editor para redactar y subir la primera crónica deportiva.</p>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>

            <div class="col-lg-4">
                <h3 class="fw-bold text-dark mb-4"><i class="bi bi-calendar-event text-danger me-2"></i>Partidos de la Semana</h3>
                
                <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                    <div class="p-3 fixture-header text-center small tracking-wide text-uppercase">
                        <i class="bi bi-trophy text-warning me-1"></i> UEFA Champions League
                    </div>
                    <ul class="list-group list-group-flush bg-white">
                        <li class="list-group-item py-3">
                            <div class="d-flex justify-content-between align-items-center text-center">
                                <span class="fw-bold col-4 text-end">Real Madrid <i class="bi bi-shield-shaded text-primary ms-1"></i></span>
                                <span class="badge bg-danger rounded-pill px-2 py-1 col-3 small fw-bold">16:00 Hs</span>
                                <span class="fw-bold col-4 text-start"><i class="bi bi-shield-shaded text-dark me-1"></i> AC Milan</span>
                            </div>
                        </li>
                        <li class="list-group-item py-3">
                            <div class="d-flex justify-content-between align-items-center text-center">
                                <span class="fw-bold col-4 text-end">Inter <i class="bi bi-shield-shaded text-primary ms-1"></i></span>
                                <span class="badge bg-secondary rounded-pill px-2 py-1 col-3 small">Mañana</span>
                                <span class="fw-bold col-4 text-start"><i class="bi bi-shield-shaded text-danger me-1"></i> Arsenal</span>
                            </div>
                        </li>
                    </ul>

                    <div class="p-3 fixture-header text-center small tracking-wide text-uppercase border-top">
                        <i class="bi bi-flag-fill text-info me-1"></i> Eliminatorias Sudamericanas
                    </div>
                    <ul class="list-group list-group-flush bg-white">
                        <li class="list-group-item py-3">
                            <div class="d-flex justify-content-between align-items-center text-center">
                                <span class="fw-bold col-4 text-end">Argentina <i class="bi bi-star-fill text-warning ms-1"></i></span>
                                <span class="badge bg-success rounded-pill px-2 py-1 col-3 small">Jueves 20:00</span>
                                <span class="fw-bold col-4 text-start"><i class="bi bi-shield-shaded text-muted me-1"></i> Perú</span>
                            </div>
                        </li>
                        <li class="list-group-item py-3">
                            <div class="d-flex justify-content-between align-items-center text-center">
                                <span class="fw-bold col-4 text-end">Brasil <i class="bi bi-shield-shaded text-warning ms-1"></i></span>
                                <span class="badge bg-success rounded-pill px-2 py-1 col-3 small">Jueves 21:45</span>
                                <span class="fw-bold col-4 text-start"><i class="bi bi-shield-shaded text-muted me-1"></i> Uruguay</span>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="card bg-dark text-white border-0 rounded-3 shadow-sm p-4 mt-4 text-center">
                    <h5 class="fw-bold text-warning mb-2"><i class="bi bi-lightning-charge-fill"></i> ¿Querés ser redactor?</h5>
                    <p class="small text-white-50">Registrate como Editor y empezá a subir tus propios análisis tácticos y crónicas de partidos directamente a la base de datos.</p>
                </div>
            </div>

        </div>
    </div>

    <footer class="bg-dark text-white-50 text-center py-4 border-top border-secondary border-3">
        <p class="m-0 small">Mundial 360 &copy; 2026 - Desarrollo de Sistemas Web II | Examen Parcial de Cancha</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
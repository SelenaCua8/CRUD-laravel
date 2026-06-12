@extends('layouts.panel')

@section('titulo', 'Portal del Hincha - Mundial 360')

@section('sidebar')
<div class="sidebar bg-secondary text-white h-100 p-3" style="min-height: 100vh;">
    <div class="text-center mb-4">
        <h4 class="fw-bold m-0 text-white">Mundial <span class="text-warning">360</span></h4>
        <span class="badge bg-light text-dark mt-2 px-3 rounded-pill">ESPECTADOR</span>
    </div>
    <hr class="border-light">
    <nav class="nav flex-column gap-2">
        <a class="nav-link text-white fw-bold active" href="/espectador/dashboard"><i class="bi bi-house-door-fill me-2"></i> Mi Espacio</a>
        <a class="nav-link text-white-50" href="/"><i class="bi bi-arrow-left-circle-fill me-2"></i> Ir al Diario</a>
    </nav>
</div>
@endsection

@section('contenido')
<div class="container-fluid p-0">
    <div class="p-5 mb-4 bg-light rounded-3 shadow-sm border-top border-secondary border-4">
        <div class="container-fluid py-2">
            <h1 class="display-6 fw-bold text-dark">¡Bienvenido a la Tribuna de Mundial 360, {{ auth()->user()->name }}!</h1>
            <p class="col-md-8 fs-6 text-muted">Este es tu espacio personalizado como lector. Desde la portada vas a poder debatir en las crónicas, dejar tus comentarios y vivir el minuto a minuto del Torneo.</p>
            <a href="/" class="btn btn-secondary btn-sm px-4 rounded-pill fw-bold">Explorar Crónicas de Hoy</a>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-4 bg-white rounded-3">
                <h5 class="fw-bold text-dark mb-3"><i class="bi bi-chat-right-text text-secondary me-2"></i>Mis Últimos Comentarios</h5>
                <p class="text-muted small">Próximamente verás acá el historial de tus debates en la plataforma.</p>
                <div class="alert alert-light border border-dashed text-center small text-muted py-3">
                    No registrás comentarios en las últimas 24 horas.
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-4 bg-white rounded-3">
                <h5 class="fw-bold text-dark mb-3"><i class="bi bi-bookmark-heart text-secondary me-2"></i>Notas Guardadas</h5>
                <p class="text-muted small">Guardá tus crónicas preferidas para leerlas cuando quieras.</p>
                <ul class="list-group list-group-flush small">
                    <li class="list-group-item px-0 text-muted"><i class="bi bi-star me-2"></i>¡Inicia el Torneo Clausura con sorpresas!</li>
                    <li class="list-group-item px-0 text-muted"><i class="bi bi-star me-2"></i>Histórico triunfo argentino</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
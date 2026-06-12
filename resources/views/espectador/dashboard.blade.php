@extends('layouts.panel')

@section('titulo', 'Mi Panel Espectador')

@section('sidebar')
<div class="sidebar bg-success text-white h-100 p-3" style="min-height: 100vh;">
    <div class="text-center mb-4">
        <h4 class="fw-bold m-0 text-white">Mundial <span class="text-dark">360</span></h4>
        <span class="badge bg-white text-success mt-2 px-3 rounded-pill fw-bold">ESPECTADOR</span>
    </div>
    <hr class="border-white-50">
    <nav class="nav flex-column gap-2">
        <a class="nav-link text-white fw-bold active" href="#"><i class="bi bi-house-door-fill me-2"></i> Inicio</a>
        <a class="nav-link text-white-50" href="#"><i class="bi bi-chat-left-text-fill me-2"></i> Mis Comentarios</a>
        <a class="nav-link text-white-50" href="#"><i class="bi bi-star-fill me-2"></i> Favoritos</a>
    </nav>
</div>
@endsection

@section('contenido')
<div class="p-4 bg-white rounded shadow-sm border-start border-success border-4">
    <h2 class="fw-bold text-dark"><i class="bi bi-chat-heart text-success me-2"></i> ¡Hola de nuevo!</h2>
    <p class="text-muted">Este es tu espacio para revisar los debates y comentarios que dejaste en las notas del Mundial.</p>
    <hr>
    <div class="alert alert-light border shadow-sm">
        <i class="bi bi-info-circle-fill text-success me-2"></i> Todavía no tenés comentarios realizados. ¡Andá a la portada y empezá a debatir!
    </div>
</div>
@endsection
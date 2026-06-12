@extends('layouts.panel')

@section('titulo', 'Admin - Reportes y Estadísticas')

@section('sidebar')
<div class="sidebar sidebar-admin">
    <div class="text-center mb-4 px-3">
        <h4 class="fw-bold m-0 text-white">Mundial <span class="text-dark">360</span></h4>
        <span class="badge badge-admin mt-2">ADMINISTRADOR</span>
    </div>
    <hr class="text-white-50">
    <nav class="nav flex-column">
        <a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="bi bi-people"></i> Gestión Usuarios</a>
        <a class="nav-link" href="{{ route('admin.posts') }}"><i class="bi bi-newspaper"></i> Supervisar Posts</a>
        <a class="nav-link" href="{{ route('admin.categorias') }}"><i class="bi bi-tags"></i> Gestión Categorías</a>
        <a class="nav-link active" href="{{ route('admin.reportes') }}"><i class="bi bi-bar-chart-line"></i> Reportes</a>
        <a class="nav-link" href="/"><i class="bi bi-arrow-left-circle"></i> Volver al Blog</a>
    </nav>
</div>
@endsection

@section('contenido')
<h4 class="fw-bold text-dark mb-4"><i class="bi bi-bar-chart-line text-danger me-2"></i> Reportes Generales del Sistema</h4>
<div class="row g-4">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm p-4 bg-white rounded-3">
            <h6 class="text-muted mb-3">Rendimiento de Publicaciones</h6>
            <div class="d-flex justify-content-between mb-2">
                <span>Notas en modo Borrador:</span>
                <span class="fw-bold text-secondary">{{ $postsBorrador }}</span>
            </div>
            <div class="progress mb-3" style="height: 10px;">
                <div class="bg-secondary" style="width: 30%"></div>
            </div>
            <div class="d-flex justify-content-between mb-2">
                <span>Notas Publicadas oficialmente:</span>
                <span class="fw-bold text-success">{{ $postsPublicados }}</span>
            </div>
            <div class="progress" style="height: 10px;">
                <div class="bg-success" style="width: 70%"></div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card border-0 shadow-sm p-4 bg-white rounded-3">
            <h6 class="text-muted mb-3">Métricas de Tráfico Simulado</h6>
            <p class="small text-muted">Interacciones estimadas para la entrega del parcial deportivo:</p>
            <ul>
                <li>Visitas únicas hoy: <strong>1.240 usuarios</strong></li>
                <li>Tiempo promedio de lectura: <strong>3 min 45 seg</strong></li>
                <li>Tasa de rebote: <strong>12%</strong></li>
            </ul>
        </div>
    </div>
</div>
@endsection
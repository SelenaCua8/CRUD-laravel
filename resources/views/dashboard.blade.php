@extends('layouts.panel')

@section('titulo', 'Dashboard Administrador')

@section('sidebar')
<div class="sidebar sidebar-admin">
    <div class="text-center mb-4 px-3">
        <h4 class="fw-bold m-0 text-white">Mundial <span class="text-dark">360</span></h4>
        <span class="badge badge-admin mt-2">ADMINISTRADOR</span>
    </div>
    <hr class="text-white-50">
    <nav class="nav flex-column">
        <a class="nav-link active" href="#"><i class="bi bi-house-door"></i> Inicio</a>
        <a class="nav-link" href="#"><i class="bi bi-people"></i> Gestión Usuarios</a>
        <a class="nav-link" href="#"><i class="bi bi-newspaper"></i> Supervisar Posts</a>
        <a class="nav-link" href="#"><i class="bi bi-tags"></i> Categorías y Tags</a>
        <a class="nav-link" href="#"><i class="bi bi-graph-up"></i> Reportes</a>
    </nav>
</div>
@endsection

@section('contenido')
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-3 bg-white">
            <div class="card-body d-flex align-items-center">
                <div class="bg-danger-subtle text-danger p-3 rounded-3 me-3">
                    <i class="bi bi-people fs-3"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1">Usuarios Totales</h6>
                    <h3 class="fw-bold m-0">1,240</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-3 bg-white">
            <div class="card-body d-flex align-items-center">
                <div class="bg-success-subtle text-success p-3 rounded-3 me-3">
                    <i class="bi bi-file-earmark-text fs-3"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1">Publicaciones</h6>
                    <h3 class="fw-bold m-0">85</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-3 bg-white">
            <div class="card-body d-flex align-items-center">
                <div class="bg-warning-subtle text-warning p-3 rounded-3 me-3">
                    <i class="bi bi-chat-left-text fs-3"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1">Comentarios Pendientes</h6>
                    <h3 class="fw-bold m-0">14</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-3 bg-white">
    <div class="card-header bg-white py-3">
        <h5 class="m-0 fw-bold text-dark">Últimos Usuarios Registrados</h5>
    </div>
    <div class="card-body">
        <p class="text-muted">Acá vas a meter la tabla de usuarios que tenías en el TP1...</p>
    </div>
</div>
@endsection
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
                    <h3 class="fw-bold m-0">{{ $totalUsuarios }}</h3>
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
                    <h3 class="fw-bold m-0">{{ $totalPosts }}</h3>
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
                    <h6 class="text-muted mb-1">Comentarios</h6>
                    <h3 class="fw-bold m-0">{{ $totalComentarios }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-3 bg-white">
    <div class="card-header bg-white py-3 border-0">
        <h5 class="m-0 fw-bold text-dark"><i class="bi bi-table me-2 text-danger"></i> Listado de Usuarios</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol asignado</th>
                        <th class="text-end pe-4">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usuarios as $user)
                    <tr>
                        <td class="ps-4 fw-bold text-secondary">#{{ $user->id }}</td>
                        <td class="fw-semibold text-dark">{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->role_id == 1)
                                <span class="badge badge-admin fs-7 rounded-pill">Administrador</span>
                            @elseif($user->role_id == 2)
                                <span class="badge badge-editor fs-7 rounded-pill text-dark">Editor</span>
                            @else
                                <span class="badge badge-espectador fs-7 rounded-pill">Espectador</span>
                            @endif
                        </td>
                        <td class="text-end pe-4">
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Seguro que querés eliminar este usuario?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger border-0 rounded-circle p-2">
                                    <i class="bi bi-trash3-fill"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
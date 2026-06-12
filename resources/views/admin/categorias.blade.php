@extends('layouts.panel')

@section('titulo', 'Admin - Gestión de Categorías')

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
        <a class="nav-link active" href="{{ route('admin.categorias') }}"><i class="bi bi-tags"></i> Gestión Categorías</a>
        <a class="nav-link" href="{{ route('admin.reportes') }}"><i class="bi bi-bar-chart-line"></i> Reportes</a>
        <a class="nav-link" href="/"><i class="bi bi-arrow-left-circle"></i> Volver al Blog</a>
    </nav>
</div>
@endsection

@section('contenido')
<div class="card border-0 shadow-sm rounded-3 bg-white">
    <div class="card-header bg-white py-3 border-0">
        <h5 class="m-0 fw-bold text-dark"><i class="bi bi-tags me-2 text-danger"></i> Control de Categorías del Blog</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">ID</th>
                        <th>Nombre de la Categoría</th>
                        <th class="text-end pe-4">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categorias as $cat)
                    <tr>
                        <td class="ps-4 fw-bold">#{{ $cat->id }}</td>
                        <td class="fw-semibold text-dark">{{ $cat->name }}</td>
                        <td class="text-end pe-4">
                            <form action="{{ route('admin.categorias.destroy', $cat->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar esta categoría?')">
                                @csrf
                                @linea('DELETE')
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger border-0 rounded-circle">
                                    <i class="bi bi-trash3-fill"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center py-4 text-muted">No hay categorías en la base de datos.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
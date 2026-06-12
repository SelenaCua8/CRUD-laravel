@extends('layouts.panel')

@section('titulo', 'Admin - Supervisar Publicaciones')

@section('sidebar')
<div class="sidebar sidebar-admin">
    <div class="text-center mb-4 px-3">
        <h4 class="fw-bold m-0 text-white">Mundial <span class="text-dark">360</span></h4>
        <span class="badge badge-admin mt-2">ADMINISTRADOR</span>
    </div>
    <hr class="text-white-50">
    <nav class="nav flex-column">
        <a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="bi bi-people"></i> Gestión Usuarios</a>
        <a class="nav-link active" href="{{ route('admin.posts') }}"><i class="bi bi-newspaper"></i> Supervisar Posts</a>
        <a class="nav-link" href="/"><i class="bi bi-arrow-left-circle"></i> Volver al Blog</a>
    </nav>
</div>
@endsection

@section('contenido')
<div class="card border-0 shadow-sm rounded-3 bg-white">
    <div class="card-header bg-white py-3 border-0">
        <h5 class="m-0 fw-bold text-dark"><i class="bi bi-shield-exclamation me-2 text-danger"></i> Panel de Supervisión Global de Contenidos</h5>
        <p class="text-muted m-0 small">Como Administrador podés moderar y eliminar cualquier artículo publicado en el sitio.</p>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Título del Post</th>
                        <th>Creador (User ID)</th>
                        <th>Estado</th>
                        <th>Fecha de Publicación</th>
                        <th class="text-end pe-4">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($posts as $post)
                    <tr>
                        <td class="ps-4 fw-semibold text-dark">{{ $post->titulo }}</td>
                        <td><span class="badge bg-light text-dark border">Autor ID: {{ $post->user_id }}</span></td>
                        <td>
                            <span class="badge bg-{{ $post->estado == 'publicado' ? 'success' : 'secondary' }} text-white">
                                {{ ucfirst($post->estado) }}
                            </span>
                        </td>
                        <td class="small text-muted">{{ $post->created_at->format('d/m/Y H:i') }}</td>
                        <td class="text-end pe-4">
                            <form action="{{ route('editor.posts.destroy', $post->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de que querés eliminar este post de la plataforma?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger border-0 rounded-circle" title="Eliminar Post">
                                    <i class="bi bi-trash3-fill"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">No hay ninguna publicación creada en la base de datos todavía.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@extends('layouts.panel')

@section('titulo', 'Admin - Moderar Comentarios')

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
        <a class="nav-link active" href="{{ route('admin.comentarios') }}"><i class="bi bi-chat-left-text"></i> Moderar Comentarios</a>
        <a class="nav-link" href="/"><i class="bi bi-arrow-left-circle"></i> Volver al Blog</a>
    </nav>
</div>
@endsection

@section('contenido')
<div class="card border-0 shadow-sm rounded-3 bg-white">
    <div class="card-header bg-white py-3 border-0">
        <h5 class="m-0 fw-bold text-dark"><i class="bi bi-chat-square-dots me-2 text-danger"></i> Moderación Global de Comentarios</h5>
        <p class="text-muted m-0 small">Como Administrador tenés el control total para eliminar mensajes ofensivos de la tribuna.</p>
    </div>
    
    @if(session('success'))
        <div class="alert alert-success mx-4 mt-3 border-0 shadow-sm small py-2">
            {{ session('success') }}
        </div>
    @endif

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Comentario</th>
                        <th>Post ID</th>
                        <th>User ID</th>
                        <th>Fecha</th>
                        <th class="text-end pe-4">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($comentarios as $comment)
                    <tr>
                        <td class="ps-4 text-dark fw-medium" style="max-width: 300px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            {{ $comment->contenido }}
                        </td>
                        <td><span class="badge bg-light text-dark border">#{{ $comment->post_id }}</span></td>
                        <td><span class="badge bg-light text-secondary border">Autor: {{ $comment->user_id }}</span></td>
                        <td class="small text-muted">
                            {{ isset($comment->created_at) ? \Carbon\Carbon::parse($comment->created_at)->format('d/m/Y H:i') : now()->format('d/m/Y H:i') }}
                        </td>
                        <td class="text-end pe-4">
                            <a href="{{ url('/posts/' . $comment->post_id) }}" target="_blank" class="btn btn-sm btn-outline-primary border-0 me-1" title="Ver publicación donde se comentó">
                                <i class="bi bi-eye-fill"></i> Ver más
                            </a>

                            <form action="{{ route('admin.comentarios.destroy', $comment->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de que querés eliminar este comentario por infringir las normas?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger border-0 rounded-circle" title="Eliminar Comentario">
                                    <i class="bi bi-trash3-fill"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">No hay comentarios realizados en la tribuna todavía.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
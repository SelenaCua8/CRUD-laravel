@extends('layouts.panel')

@section('titulo', 'Panel Editor - Gestión Integral')

@section('sidebar')
<div class="sidebar bg-warning text-dark h-100 p-3" style="min-height: 100vh;">
    <div class="text-center mb-4">
        <h4 class="fw-bold m-0">Mundial <span class="text-success">360</span></h4>
        <span class="badge bg-dark mt-2 px-3 rounded-pill">EDITOR</span>
    </div>
    <hr class="border-dark">
    <nav class="nav flex-column gap-2">
        <a class="nav-link text-dark fw-bold active" href="/editor/dashboard"><i class="bi bi-speedometer2 me-2"></i> Mi Dashboard</a>
        <a class="nav-link text-dark" href="/"><i class="bi bi-arrow-left-circle-fill me-2"></i> Volver al Blog</a>
    </nav>
</div>
@endsection

@section('contenido')
<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark m-0">Espacio de Trabajo del Editor</h3>
    </div>

    <ul class="nav nav-tabs mb-4" id="editorTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active fw-semibold text-dark" id="posts-tab" data-bs-toggle="tab" data-bs-target="#posts-pane" type="button" role="tab"><i class="bi bi-file-earmark-text me-2"></i>Publicaciones (CRUD)</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link fw-semibold text-dark" id="taxonomias-tab" data-bs-toggle="tab" data-bs-target="#taxonomias-pane" type="button" role="tab"><i class="bi bi-tags me-2"></i>Categorías y Etiquetas</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link fw-semibold text-dark" id="comentarios-tab" data-bs-toggle="tab" data-bs-target="#comentarios-pane" type="button" role="tab"><i class="bi bi-chat-left-dots me-2"></i>Moderación de Comentarios</button>
        </li>
    </ul>

    <div class="tab-content" id="editorTabsContent">
        
        <div class="tab-pane fade show active" id="posts-pane" role="tabpanel">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm p-4 rounded-3 bg-white border-top border-warning border-4">
                        <h5 class="fw-bold text-dark mb-3">Nueva Nota</h5>
                        <form action="{{ route('editor.posts.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label small fw-bold">Título</label>
                                <input type="text" name="titulo" class="form-control form-control-sm" required placeholder="Título deportivo...">
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-bold">Categoría Asociada</label>
                                <select name="category_id" class="form-select form-select-sm" required>
                                    @foreach($categorias as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-bold">Estado</label>
                                <select name="estado" class="form-select form-select-sm">
                                    <option value="borrador">Borrador</option>
                                    <option value="publicado">Publicado</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-bold">URL Imagen</label>
                                <input type="url" name="imagen_url" class="form-control form-control-sm" placeholder="https://...">
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-bold">Contenido</label>
                                <textarea name="contenido" class="form-control form-control-sm" rows="4" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-warning btn-sm w-100 fw-bold rounded-pill">Publicar Artículo</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card border-0 shadow-sm rounded-3 bg-white">
                        <div class="card-body p-0">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-4">Título</th>
                                        <th>Estado</th>
                                        <th class="text-end pe-4">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($posts as $post)
                                    <tr>
                                        <td class="ps-4 fw-semibold">{{ $post->titulo }}</td>
                                        <td><span class="badge bg-{{ $post->estado == 'publicado' ? 'success' : 'secondary' }}">{{ $post->estado }}</span></td>
                                        <td class="text-end pe-4">
                                            <form action="{{ route('editor.posts.destroy', $post->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger border-0"><i class="bi bi-trash3-fill"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr><td colspan="3" class="text-center py-4 text-muted">No creaste publicaciones todavía.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="taxonomias-pane" role="tabpanel">
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm p-4 bg-white">
                        <h5 class="fw-bold text-dark mb-3"><i class="bi bi-folder-plus text-warning me-2"></i>Agregar Categoría</h5>
                        <form action="{{ route('editor.categorias.store') }}" method="POST" class="d-flex gap-2 mb-3">
                            @csrf
                            <input type="text" name="name" class="form-control form-control-sm" required placeholder="Ej: Básquet">
                            <button type="submit" class="btn btn-warning btn-sm fw-bold px-3 rounded-pill">Añadir</button>
                        </form>
                        <h6 class="fw-bold small text-muted">Categorías en el Sistema:</h6>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($categorias as $cat)
                                <span class="badge bg-light text-dark border p-2"><i class="bi bi-tag-fill text-warning me-1"></i> {{ $cat->name }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm p-4 bg-white">
                        <h5 class="fw-bold text-dark mb-3"><i class="bi bi-bookmark-plus text-warning me-2"></i>Agregar Etiqueta (Tag)</h5>
                        <form action="{{ route('editor.etiquetas.store') }}" method="POST" class="d-flex gap-2 mb-3">
                            @csrf
                            <input type="text" name="name" class="form-control form-control-sm" required placeholder="Ej: #Scaloneta">
                            <button type="submit" class="btn btn-warning btn-sm fw-bold px-3 rounded-pill">Añadir</button>
                        </form>
                        <h6 class="fw-bold small text-muted">Etiquetas en el Sistema:</h6>
                        <div class="d-flex flex-wrap gap-2">
                            @forelse($etiquetas as $tag)
                                <span class="badge bg-dark text-white p-2">#{{ $tag->name }}</span>
                            @empty
                                <span class="text-muted small">No hay etiquetas creadas todavía.</span>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="comentarios-pane" role="tabpanel">
            <div class="card border-0 shadow-sm bg-white">
                <div class="card-body p-0">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Usuario</th>
                                <th>Comentario</th>
                                <th>Artículo</th>
                                <th class="text-end pe-4">Acción de Moderación</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($comentarios as $com)
                            <tr>
                                <td class="ps-4 fw-bold text-secondary">{{ $com['usuario'] }}</td>
                                <td class="italic">"{{ $com['texto'] }}"</td>
                                <td><span class="badge bg-light text-dark border">{{ $com['post'] }}</span></td>
                                <td class="text-end pe-4">
                                    <button class="btn btn-xs btn-outline-success border-0 me-2" onclick="alert('Comentario aprobado')"><i class="bi bi-check-circle-fill"></i> Aprobar</button>
                                    <button class="btn btn-xs btn-outline-danger border-0" onclick="alert('Comentario rechazado/eliminado')"><i class="bi bi-x-circle-fill"></i> Rechazar</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
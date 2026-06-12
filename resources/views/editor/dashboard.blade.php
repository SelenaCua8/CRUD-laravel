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
    
    <ul class="nav nav-tabs mb-4" id="editorTabs" role="tablist">
        <li class="nav-item">
            <button class="nav-link active fw-bold text-dark" id="posts-tab" data-bs-toggle="tab" data-bs-target="#posts-pane" type="button" role="tab"><i class="bi bi-file-earmark-text me-1"></i> Publicaciones (CRUD)</button>
        </li>
        <li class="nav-item">
            <button class="nav-link fw-bold text-dark" id="taxonomias-tab" data-bs-toggle="tab" data-bs-target="#taxonomias-pane" type="button" role="tab"><i class="bi bi-tags me-1"></i> Categorías y Etiquetas</button>
        </li>
        <li class="nav-item">
            <button class="nav-link fw-bold text-dark" id="comentarios-tab" data-bs-toggle="tab" data-bs-target="#comentarios-pane" type="button" role="tab"><i class="bi bi-chat-left-dots me-1"></i> Moderación</button>
        </li>
    </ul>

    <div class="tab-content" id="editorTabsContent">
        
        <div class="tab-pane fade show active" id="posts-pane" role="tabpanel">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm p-4 bg-white border-top border-warning border-4 rounded-3">
                        <h5 class="fw-bold text-dark mb-3"><i class="bi bi-pencil-square text-warning me-2"></i>Nueva Nota</h5>
                        <form action="{{ route('editor.posts.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label small fw-semibold">Título del Artículo</label>
                                <input type="text" name="titulo" class="form-control form-control-sm" required placeholder="Ej: Histórico triunfo argentino">
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-semibold">Categoría Relacionada</label>
                                <select name="category_id" class="form-select form-select-sm" required>
                                    @forelse($categorias as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
                                    @empty
                                        <option value="">Cargá una categoría en la otra pestaña</option>
                                    @endforelse
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-semibold">Estado</label>
                                <select name="estado" class="form-select form-select-sm">
                                    <option value="publicado">Publicado</option>
                                    <option value="borrador">Borrador</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-semibold">URL de la Imagen</label>
                                <input type="url" name="imagen_url" class="form-control form-control-sm" placeholder="https://images.unsplash.com/...">
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-semibold">Cuerpo de la Nota</label>
                                <textarea name="contenido" class="form-control form-control-sm" rows="4" required placeholder="Escribí acá..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-warning btn-sm w-100 fw-bold rounded-pill shadow-sm">Subir Nota</button>
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
                                        <td class="ps-4 fw-semibold text-dark">{{ $post->titulo }}</td>
                                        <td><span class="badge bg-{{ $post->estado == 'publicado' ? 'success' : 'secondary' }}">{{ $post->estado }}</span></td>
                                        <td class="text-end pe-4">
                                            <form action="{{ route('editor.posts.destroy', $post->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿De verdad querés borrar esta crónica?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger border-0"><i class="bi bi-trash3-fill"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr><td colspan="3" class="text-center py-4 text-muted">No redactaste ninguna crónica todavía.</td></tr>
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
                    <div class="card border-0 shadow-sm p-4 bg-white rounded-3">
                        <h5 class="fw-bold text-dark mb-3"><i class="bi bi-folder-plus text-warning me-2"></i>Gestión de Categorías</h5>
                        <form action="{{ route('editor.categorias.store') }}" method="POST" class="d-flex gap-2 mb-4">
                            @csrf
                            <input type="text" name="name" class="form-control form-control-sm" required placeholder="Ej: Eliminatorias">
                            <button type="submit" class="btn btn-warning btn-sm fw-bold px-3 rounded-pill shadow-sm">Añadir</button>
                        </form>
                        
                        <h6 class="fw-bold small text-muted mb-2">Categorías creadas (con opción de eliminar):</h6>
                        <ul class="list-group">
                            @foreach($categorias as $cat)
                                <li class="list-group-item d-flex justify-content-between align-items-center bg-light border-0 mb-2 rounded-3">
                                    <span><i class="bi bi-tag-fill text-warning me-2"></i>{{ $cat->nombre }}</span>
                                    <form action="{{ route('editor.categorias.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('¿De verdad querés eliminar esta categoría?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm text-danger border-0 p-0 bg-transparent"><i class="bi bi-trash3-fill"></i></button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm p-4 bg-white rounded-3">
                        <h5 class="fw-bold text-dark mb-3"><i class="bi bi-bookmark-plus text-warning me-2"></i>Gestión de Etiquetas (Tags)</h5>
                        <form action="{{ route('editor.etiquetas.store') }}" method="POST" class="d-flex gap-2 mb-4">
                            @csrf
                            <input type="text" name="name" class="form-control form-control-sm" required placeholder="Ej: Scaloneta">
                            <button type="submit" class="btn btn-warning btn-sm fw-bold px-3 rounded-pill shadow-sm">Añadir</button>
                        </form>
                        
                        <h6 class="fw-bold small text-muted mb-2">Etiquetas activas:</h6>
                        <div class="d-flex flex-wrap gap-2">
                            @forelse($etiquetas as $tag)
                                <div class="badge bg-dark text-white p-2 d-flex align-items-center gap-2 rounded-pill shadow-sm">
                                    <span>#{{ $tag->nombre }}</span>
                                    <form action="{{ route('editor.etiquetas.destroy', $tag->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar esta etiqueta?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm p-0 m-0 text-danger border-0 bg-transparent line-height-1"><i class="bi bi-x-circle-fill"></i></button>
                                    </form>
                                </div>
                            @empty
                                <span class="text-muted small">No hay etiquetas cargadas.</span>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="comentarios-pane" role="tabpanel">
            <div class="card border-0 shadow-sm bg-white rounded-3">
                <div class="card-body p-0">
                    <table class="table align-middle mb-0 table-hover">
    <thead class="table-light">
        <tr>
            <th class="ps-4">Usuario</th>
            <th>Comentario</th>
            <th>Nota Relacionada</th>
            <th class="text-end pe-4">Acciones de Moderación</th>
        </tr>
    </thead>
    <tbody>
        @forelse($comentarios as $com)
        <tr>
            <td class="ps-4 fw-bold text-secondary">{{ optional($com)->usuario ?? 'Anónimo' }}</td>
            <td class="fst-italic">"{{ $com->contenido ?? '' }}"</td>
            <td><span class="badge bg-light text-dark border">{{ $com->post ?? 'General' }}</span></td>
            <td class="text-end pe-4">
                <form action="{{ route('editor.comentarios.destroy', $com->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Confirmás que querés eliminar este comentario de la plataforma?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger border-0">
                        <i class="bi bi-trash3-fill me-1"></i> Eliminar Comentario
                    </button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="text-center py-4 text-muted">No hay comentarios en la plataforma en este momento.</td>
        </tr>
        @endforelse
    </tbody>
</table>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
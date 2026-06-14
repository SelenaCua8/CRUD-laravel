@extends('layouts.panel')

@section('titulo', 'Editor - Modificar Crónica')

@section('sidebar')
<div class="sidebar bg-warning text-dark h-100 p-3" style="min-height: 100vh;">
    <div class="text-center mb-4">
        <h4 class="fw-bold m-0">Mundial <span class="text-success">360</span></h4>
        <span class="badge bg-dark mt-2 px-3 rounded-pill">EDITOR</span>
    </div>
    <hr class="border-dark">
    <nav class="nav flex-column gap-2">
        <a class="nav-link text-dark fw-bold" href="/editor/dashboard"><i class="bi bi-arrow-left-circle-fill me-2"></i> Cancelar y Volver</a>
    </nav>
</div>
@endsection

@section('contenido')
<div class="container-fluid">
    <div class="card shadow-sm p-4 bg-white border-top border-warning border-4 rounded-3" style="max-width: 600px;">
        <h5 class="fw-bold text-dark mb-3"><i class="bi bi-pencil-square text-warning me-2"></i>Modificar Crónica</h5>
        
        <form action="{{ route('editor.posts.update', $post->id) }}" method="POST">
            @csrf
            @method('PUT') <div class="mb-3">
                <label class="form-label small fw-semibold">Título del Artículo</label>
                <input type="text" name="titulo" class="form-control" value="{{ $post->titulo }}" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label small fw-semibold">Categoría Relacionada</label>
                <select name="category_id" class="form-select" required>
                    @foreach($categorias as $cat)
                        <option value="{{ $cat->id }}" {{ $post->category_id == $cat->id ? 'selected' : '' }}>
                            {{ $cat->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="mb-3">
                <label class="form-label small fw-semibold">Estado</label>
                <select name="estado" class="form-select">
                    <option value="publicado" {{ $post->estado == 'publicado' ? 'selected' : '' }}>Publicado</option>
                    <option value="borrador" {{ $post->estado == 'borrador' ? 'selected' : '' }}>Borrador</option>
                </select>
            </div>
            
            <div class="mb-3">
                <label class="form-label small fw-semibold">URL de la Imagen</label>
                <input type="url" name="imagen_url" class="form-control" value="{{ $post->imagen_url ?? '' }}">
            </div>
            
            <div class="mb-3">
                <label class="form-label small fw-semibold">Cuerpo de la Nota</label>
                <textarea name="contenido" class="form-control" rows="6" required>{{ $post->contenido }}</textarea>
            </div>
            
            <button type="submit" class="btn btn-warning fw-bold w-100 rounded-pill shadow-sm">💾 Guardar Cambios Reales</button>
        </form>
    </div>
</div>
@endsection
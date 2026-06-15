<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| 1. VISTAS PÚBLICAS DEL DIARIO DEPORTIVO
|--------------------------------------------------------------------------
*/
// Portada principal del blog
Route::get('/', [PublicController::class, 'index'])->name('public.home');

// Lectura de artículos y categorías sin restricciones de rol
Route::get('/posts/{id}', [PublicController::class, 'show'])->name('public.detalle');
Route::get('/categorias/{id}', [PublicController::class, 'categoria'])->name('public.categoria');


/*
|--------------------------------------------------------------------------
| 2. DISTRIBUIDOR DE LOGINS
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    $roleId = auth()->user()->role_id;

    if ($roleId == 1) {
        return redirect()->route('admin.dashboard');
    } elseif ($roleId == 2) {
        return redirect()->route('editor.dashboard');
    } else {
        return redirect()->route('espectador.dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');


/*
|--------------------------------------------------------------------------
| 3. RUTAS PROTEGIDAS PARA EL ADMINISTRADOR (ROL 1)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'rol:1'])->group(function () {
    // Dashboard principal (Gestión de usuarios)
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::delete('/admin/users/{id}', [AdminController::class, 'destroy'])->name('admin.users.destroy');
    
    // Moderación global de publicaciones
    Route::get('/admin/posts', [AdminController::class, 'supervisarPosts'])->name('admin.posts');
    Route::delete('/admin/posts/{id}', [AdminController::class, 'destroyPost'])->name('admin.posts.destroy'); 
    
    // Gestión de Categorías y Reportes
    Route::get('/admin/categorias', [AdminController::class, 'gestionCategorias'])->name('admin.categorias');
    Route::delete('/admin/categorias/{id}', [AdminController::class, 'destroyCategoria'])->name('admin.categorias.destroy');
    Route::get('/admin/reportes', [AdminController::class, 'reportes'])->name('admin.reportes');
    
    // 📢 MODERACIÓN DE COMENTARIOS (Corregido el orden lógico)
    Route::get('/admin/comentarios', [AdminController::class, 'mostrarComentarios'])->name('admin.comentarios');
    Route::delete('/admin/comentarios/{id}', [AdminController::class, 'destroyComentario'])->name('admin.comentarios.destroy');
});


/*
|--------------------------------------------------------------------------
| 4. RUTAS PROTEGIDAS PARA EL EDITOR (ROL 2)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'rol:2'])->group(function () {
    Route::get('/editor/dashboard', [PostController::class, 'index'])->name('editor.dashboard');
    
    Route::post('/editor/posts', [PostController::class, 'store'])->name('editor.posts.store');
    Route::post('/editor/categorias', [PostController::class, 'storeCategoria'])->name('editor.categorias.store');
    Route::post('/editor/etiquetas', [PostController::class, 'storeEtiqueta'])->name('editor.etiquetas.store');
    
    // El tacho de basura para el Editor:
    Route::delete('/editor/categorias/{id}', [PostController::class, 'destroyCategoria'])->name('editor.categorias.destroy');
    Route::delete('/editor/etiquetas/{id}', [PostController::class, 'destroyEtiqueta'])->name('editor.etiquetas.destroy');
    Route::delete('/editor/comentarios/{id}', [PostController::class, 'destroyComentario'])->name('editor.comentarios.destroy');
    Route::get('/editor/posts/{id}/edit', [PostController::class, 'edit'])->name('editor.posts.edit');
Route::put('/editor/posts/{id}', [PostController::class, 'update'])->name('editor.posts.update');

    Route::get('/editor/posts', function() { return redirect()->route('editor.dashboard'); });
    Route::get('/editor/categorias', function() { return redirect()->route('editor.dashboard'); });
    Route::get('/editor/etiquetas', function() { return redirect()->route('editor.dashboard'); });
   

});


/*
|--------------------------------------------------------------------------
| 5. RUTAS PROTEGIDAS PARA EL ESPECTADOR LOGUEADO (ROL 3)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'rol:3'])->group(function () {
    Route::get('/espectador/dashboard', function () {
        return view('espectador.dashboard');
    })->name('espectador.dashboard');
});


/*
|--------------------------------------------------------------------------
| 6. INTERACCIONES GLOBALES DE USUARIOS AUTENTICADOS
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // Guardar comentarios reales desde el blog público
    Route::post('/comentarios', [CommentController::class, 'store'])->name('comments.store');
});

// Ruta pública para ver una crónica completa
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');


// Sistema de autenticación de Breeze
require __DIR__.'/auth.php';
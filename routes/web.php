<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
Route::delete('/admin/comentarios/{id}', [AdminController::class, 'destroyComentario'])->name('admin.comentarios.destroy');

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
| 2. DISTRIBUIDOR DE LOGINS (EL FILTRO INTELIGENTE)
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
    Route::delete('/admin/posts/{id}', [AdminController::class, 'destroyPost'])->name('admin.posts.destroy'); // <-- ¡ESTA ES LA QUE AGREGAMOS!
    
    // Gestión analítica y de taxonomías
    Route::get('/admin/categorias', [AdminController::class, 'gestionCategorias'])->name('admin.categorias');
    Route::delete('/admin/categorias/{id}', [AdminController::class, 'destroyCategoria'])->name('admin.categorias.destroy');
    Route::get('/admin/reportes', [AdminController::class, 'reportes'])->name('admin.reportes');
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
    
    // Agregamos los tacho de basura para Categorías, Etiquetas y Comentarios:
    Route::delete('/editor/categorias/{id}', [PostController::class, 'destroyCategoria'])->name('editor.categorias.destroy');
    Route::delete('/editor/etiquetas/{id}', [PostController::class, 'destroyEtiqueta'])->name('editor.etiquetas.destroy');
    Route::delete('/editor/comentarios/{id}', [PostController::class, 'destroyComentario'])->name('editor.comentarios.destroy');

    Route::get('/editor/posts', function() { return redirect()->route('editor.dashboard'); });
    Route::get('/editor/categorias', function() { return redirect()->route('editor.dashboard'); });
    Route::get('/editor/etiquetas', function() { return redirect()->route('editor.dashboard'); });
    
    Route::delete('/editor/posts/{id}', [PostController::class, 'destroy'])->name('editor.posts.destroy');
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
| 6. RUTAS DE PERFIL DEL USUARIO (NATIVAS DE BREEZE)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // NUEVA RUTA: Guardar comentarios reales
    Route::post('/comentarios', [CommentController::class, 'store'])->name('comments.store');
});
});


// Sistema de autenticación de Breeze
require __DIR__.'/auth.php';
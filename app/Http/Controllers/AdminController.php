<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\DB; // Para simular reportes rápidos

class AdminController extends Controller
{
    // Dashboard principal con estadísticas rápidas
    public function dashboard()
    {
        $usuarios = User::all();
        $totalUsuarios = User::count();
        $totalPosts = Post::count(); 
        $totalComentarios = 14; 

        return view('admin.dashboard', compact('usuarios', 'totalUsuarios', 'totalPosts', 'totalComentarios'));
    }

    // Supervisión de Publicaciones
    public function supervisarPosts()
    {
        $posts = Post::all();
        return view('admin.posts', compact('posts'));
    }

    // NUEVO: Gestión de Categorías para el Admin
    public function gestionCategorias()
    {
        // Traemos las categorías directamente de la base de datos
        $categorias = DB::table('categories')->get();
        return view('admin.categorias', compact('categorias'));
    }

    // NUEVO: Acceso a Reportes y Estadísticas
    public function reportes()
    {
        $totalUsuarios = User::count();
        $totalPosts = Post::count();
        
        // Simulación de datos para gráficos rápidos de Bootstrap
        $postsPublicados = Post::where('estado', 'publicado')->count();
        $postsBorrador = Post::where('estado', 'borrador')->count();

        return view('admin.reportes', compact('totalUsuarios', 'totalPosts', 'postsPublicados', 'postsBorrador'));
    }

    // Eliminar un usuario
    public function destroy($id)
    {
        $usuario = User::findOrFail($id);
        if ($usuario->id === auth()->id()) {
            return redirect()->back()->with('error', 'No podés borrar tu propia cuenta.');
        }
        $usuario->delete();
        return redirect()->back()->with('success', 'Usuario eliminado correctamente.');
    }

    // Eliminar una categoría
    public function destroyCategoria($id)
    {
        DB::table('categories')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Categoría eliminada correctamente.');
    }

    // NUEVO: Eliminar una publicación desde el rol de Administrador
    public function destroyPost($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->back()->with('success', 'La crónica fue eliminada por el Administrador.');
    }
    public function destroyComentario($id)
{
    DB::table('comments')->where('id', $id)->delete();
    return redirect()->back()->with('success', 'El Administrador eliminó el comentario por infringir las normas.');
}
}
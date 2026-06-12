<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    // 1. Dashboard principal con estadísticas REALES de la Base de Datos
    public function dashboard()
    {
        // Contamos la data en tiempo real
        $totalUsuarios = User::count();
        $totalPosts = Post::count(); 
        $totalComentarios = DB::table('comments')->count(); 

        // Traemos los usuarios para la tabla de gestión
        $usuarios = User::all();

        return view('admin.dashboard', compact('usuarios', 'totalUsuarios', 'totalPosts', 'totalComentarios'));
    }

    // 2. Supervisión de Publicaciones
    public function supervisarPosts()
    {
        $posts = Post::all();
        return view('admin.posts', compact('posts'));
    }

    // 3. Gestión de Categorías para el Admin
    public function gestionCategorias()
    {
        $categorias = DB::table('categories')->get();
        return view('admin.categorias', compact('categorias'));
    }

    // 4. Acceso a Reportes y Estadísticas Reales
    public function reportes()
    {
        $totalUsuarios = User::count();
        $totalPosts = Post::count();
        
        // Contadores según el estado de la nota
        $postsPublicados = Post::where('estado', 'publicado')->count();
        $postsBorrador = Post::where('estado', 'borrador')->count();

        return view('admin.reportes', compact('totalUsuarios', 'totalPosts', 'postsPublicados', 'postsBorrador'));
    }

    // 5. Eliminar un usuario de forma segura (Evita suicidio de cuenta)
    public function destroy($id)
    {
        $usuario = User::findOrFail($id);
        
        if ($usuario->id === auth()->id()) {
            return redirect()->back()->with('error', 'No podés borrar tu propia cuenta.');
        }
        
        $usuario->delete();
        return redirect()->back()->with('success', 'Usuario eliminado correctamente.');
    }

    // 6. Eliminar una categoría
    public function destroyCategoria($id)
    {
        DB::table('categories')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Categoría eliminada correctamente.');
    }

    // 7. Eliminar una publicación desde el rol de Administrador
    public function destroyPost($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->back()->with('success', 'La crónica fue eliminada por el Administrador.');
    }

    // 8. Eliminar un comentario ofensivo
    public function destroyComentario($id)
    {
        DB::table('comments')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'El Administrador eliminó el comentario por infringir las normas.');
    }
}
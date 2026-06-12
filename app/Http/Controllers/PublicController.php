<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class PublicController extends Controller
{
    // Portada principal: Trae los posts para el welcome
    public function index()
    {
        $posts = Post::where('estado', 'publicado')->latest()->get();
        // Traemos las categorías para el menú de filtros
        $categorias = DB::table('categories')->get(); 
        
        return view('welcome', compact('posts', 'categorias'));
    }

    // Detalle de una publicación específica con sus comentarios aprobados
    public function show($id)
    {
        // 1. Buscamos el post por ID
        $post = Post::findOrFail($id);

        // 2. Traemos ÚNICAMENTE los comentarios de este post que estén 'aprobado' (Uniendo con la tabla users para el nombre)
        $comentarios = DB::table('comments')
            ->join('users', 'comments.user_id', '=', 'users.id')
            ->where('comments.post_id', $id)
            ->where('comments.estado', 'aprobado') // <-- Usa 'aprobado' que es el valor real de tu migración
            ->select('comments.*', 'users.name as nombre_usuario')
            ->orderBy('comments.created_at', 'desc')
            ->get();

        return view('public.detalle', compact('post', 'comentarios'));
    }

    // Listado de publicaciones filtradas por categoría
    public function categoria($id)
    {
        $categoria = DB::table('categories')->where('id', $id)->first();
        
        if (!$categoria) {
            return redirect('/')->with('error', 'Categoría no encontrada.');
        }

        $posts = Post::where('category_id', $id)->where('estado', 'publicado')->get();
        return view('public.categoria', compact('posts', 'categoria'));
    }
}
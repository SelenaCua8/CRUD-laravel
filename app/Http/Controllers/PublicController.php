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

    // Detalle de una publicación específica (¡Ahora visible para el Admin también!)
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('public.detalle', compact('post'));
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
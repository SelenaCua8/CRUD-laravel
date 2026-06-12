<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    // 1. Mostrar el Dashboard con toda la data junta
    public function index()
    {
        // Si es Admin ve todo para supervisar, si es Editor ve solo lo suyo
        $posts = auth()->user()->role_id == 1 
            ? Post::all() 
            : Post::where('user_id', auth()->id())->get();

        // Traemos las categorías de la base de datos para el select del formulario
        $categorias = DB::table('categories')->get();
        
        // Traemos las etiquetas de la base de datos
        $etiquetas = DB::table('tags')->get(); 
        
        // Simulación de comentarios para la pestaña de moderación del parcial
       // Comentarios reales de la base de datos para moderar
$comentarios = DB::table('comments')
    ->join('users', 'comments.user_id', '=', 'users.id')
    ->join('posts', 'comments.post_id', '=', 'posts.id')
    ->select('comments.*', 'users.name as usuario', 'posts.titulo as post')
    ->get();

        return view('editor.dashboard', compact('posts', 'categorias', 'etiquetas', 'comentarios'));

        
    }

    // 2. CRUD: Guardar Publicación en la Base de Datos
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|max:255',
            'contenido' => 'required',
            'imagen_url' => 'nullable|url',
            'category_id' => 'required|integer',
            'estado' => 'required|in:borrador,publicado'
        ]);

        Post::create([
            'titulo' => $request->titulo,
            'contenido' => $request->contenido,
            'imagen_url' => $request->imagen_url ?? 'https://images.unsplash.com/photo-1508098682722-e99c43a406b2?w=500',
            'user_id' => auth()->id(), // El ID del Editor que está creando la nota
            'category_id' => $request->category_id,
            'estado' => $request->estado
        ]);

        return redirect()->back()->with('success', '¡Crónica publicada con éxito!');
    }

    // 3. CRUD: Crear Categoría desde el Panel (¡CON SLUG INCLUIDO!)
    public function storeCategoria(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        
        DB::table('categories')->insert([
            'nombre' => $request->name, 
            'slug' => \Illuminate\Support\Str::slug($request->name), // <-- ESTO GENERA EL SLUG AUTOMÁTICO
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->back()->with('success', '¡Categoría guardada con éxito!');
    }

    // 4. CRUD: Crear Etiqueta (Tag) desde el Panel
    public function storeEtiqueta(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        
        DB::table('tags')->insert([
            'nombre' => $request->name, 
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->back()->with('success', 'Etiqueta registrada.');
    }

    // 5. CRUD: Eliminar Nota
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->back()->with('success', 'Publicación eliminada de la plataforma.');
    }

    // 6. CRUD: Eliminar Categoría desde el Editor
    public function destroyCategoria($id)
    {
        DB::table('categories')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Categoría eliminada con éxito.');
    }

    // 7. CRUD: Eliminar Etiqueta desde el Editor
    public function destroyEtiqueta($id)
    {
        DB::table('tags')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Etiqueta eliminada con éxito.');
    }

    // 8. MODERACIÓN: Eliminar/Rechazar comentario (Ajustado para simulación segura)
  public function destroyComentario($id)
{
    DB::table('comments')->where('id', $id)->delete();
    return redirect()->back()->with('success', 'Comentario moderado y eliminado correctamente.');
}

// NUEVO: El Editor aprueba el comentario cambiándole el estado
    public function aprobarComentario($id)
    {
        DB::table('comments')->where('id', $id)->update(['estado' => 'aprobado', 'updated_at' => now()]);
        return redirect()->back()->with('success', 'Comentario aprobado. Ya se ve en el blog público.');
    }

    
}
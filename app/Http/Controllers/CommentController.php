<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
   public function store(Request $request)
{
    $request->validate([
        'post_id' => 'required|integer',
        'contenido' => 'required|string|max:1000'
    ]);

    // Guardamos directo con estado 'aprobado'
    DB::table('comments')->insert([
        'post_id' => $request->post_id,
        'user_id' => auth()->id(), 
        'contenido' => $request->contenido,
        'estado' => 'aprobado', 
        'created_at' => now(),
        'updated_at' => now()
    ]);

    return redirect()->back()->with('success', '¡Tu comentario fue publicado con éxito en la tribuna!');
}

     
}
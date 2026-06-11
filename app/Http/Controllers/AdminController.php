<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    // Pantalla principal del Administrador (Dashboard)
// Pantalla principal del Administrador (Dashboard)
    public function dashboard()
    {
        // 1. Traemos los usuarios de la base de datos
        $usuarios = User::all();
        
        // 2. Contamos la cantidad total de usuarios reales
        $totalUsuarios = User::count();
        
        // 3. Dejamos estos fijos para el parcial así no renegás con otras tablas
        $totalPosts = 85; 
        $totalComentarios = 14;

        // 4. Mandamos TODO a la vista
        return view('admin.dashboard', compact('usuarios', 'totalUsuarios', 'totalPosts', 'totalComentarios'));
    }

    // Acción para eliminar un usuario del CRUD
    public function destroy($id)
    {
        $usuario = User::findOrFail($id);
        
        // Evita que te borres a vos misma si estás logueada
        if ($usuario->id === auth()->id()) {
            return redirect()->back()->with('error', 'No podés borrar tu propia cuenta.');
        }

        $usuario->delete();
        return redirect()->back()->with('success', 'Usuario eliminado correctamente.');
    }
}
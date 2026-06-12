<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // 1. Agregamos el permiso para rellenar los campos desde el formulario (Esto soluciona tu error)
    protected $fillable = [
        'titulo',
        'contenido',
        'imagen_url',
        'user_id',
        'category_id',
        'estado'
    ];

    // 2. Tus relaciones existentes (Se quedan intactas abajo)
    
    // El post pertenece al usuario que lo redactó
    public function user() {
        return $this->belongsTo(User::class);
    }

    // El post pertenece a una categoría
    public function category() {
        return $this->belongsTo(Category::class);
    }

    // El post tiene muchos comentarios
    public function comments() {
        return $this->hasMany(Comment::class);
    }

    // El post comparte muchas etiquetas (Muchos a Muchos)
    public function tags() {
        return $this->belongsToMany(Tag::class);
    }
}
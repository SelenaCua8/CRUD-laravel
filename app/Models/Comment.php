<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // El comentario fue hecho por un usuario
public function user() {
    return $this->belongsTo(User::class);
}
// El comentario pertenece a una publicación
public function post() {
    return $this->belongsTo(Post::class);
}
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. LIMPIEZA 
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('comments')->truncate();
        DB::table('post_tag')->truncate();
        DB::table('posts')->truncate();
        DB::table('tags')->truncate();
        DB::table('categories')->truncate();
        DB::table('users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 2. CREAR LOS USUARIOS DEL SISTEMA
        $adminId = DB::table('users')->insertGetId([
            'name' => 'Bruno Admin',
            'email' => 'admin@mundial.com',
            'password' => Hash::make('12345678'),
            'role_id' => 1, // Rol Admin
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $editorId = DB::table('users')->insertGetId([
            'name' => 'Selena Editora',
            'email' => 'editor@mundial.com',
            'password' => Hash::make('12345678'),
            'role_id' => 2, // Rol Editor
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $espectadorId = DB::table('users')->insertGetId([
            'name' => 'Juan Hincha',
            'email' => 'espectador@mundial.com',
            'password' => Hash::make('12345678'),
            'role_id' => 3, // Rol Espectador
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // 3. CREAR CATEGORÍAS 
        $catSeleccion = DB::table('categories')->insertGetId([
            'nombre' => 'Selección Argentina',
            'slug' => 'seleccion-argentina',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $catHistorias = DB::table('categories')->insertGetId([
            'nombre' => 'Historias de los Mundiales',
            'slug' => 'historias-de-los-mundiales',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // 4. CREAR ETIQUETAS
        $tagMessi = DB::table('tags')->insertGetId(['nombre' => 'Messi', 'created_at' => now(), 'updated_at' => now()]);
        $tagScaloneta = DB::table('tags')->insertGetId(['nombre' => 'Scaloneta', 'created_at' => now(), 'updated_at' => now()]);
        $tagQatar = DB::table('tags')->insertGetId(['nombre' => 'Qatar2022', 'created_at' => now(), 'updated_at' => now()]);

        // 5. CREAR PUBLICACIONES 
        $post1 = DB::table('posts')->insertGetId([
            'titulo' => 'La Scaloneta se prepara para el próximo desafío',
            'contenido' => 'El cuerpo técnico de la Selección Argentina ya planifica los entrenamientos con el plantel completo enfocado en mantener el nivel competitivo más alto del mundo.',
            'imagen_url' => 'https://images.unsplash.com/photo-1508098682722-e99c43a406b2?w=500',
            'estado' => 'publicado',
            'user_id' => $editorId,
            'category_id' => $catSeleccion,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $post2 = DB::table('posts')->insertGetId([
            'titulo' => 'El día que Messi tocó el cielo en Qatar',
            'contenido' => 'Un repaso emocionante por la final del mundo en Lusail, reviviendo los goles y la mística de una tarde que quedará grabada por siempre en la memoria de todos.',
            'imagen_url' => 'https://images.unsplash.com/photo-1543351611-58f69d7c1781?w=500',
            'estado' => 'publicado',
            'user_id' => $editorId,
            'category_id' => $catHistorias,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Relacionar las publicaciones con sus etiquetas en la intermedia
        DB::table('post_tag')->insert([
            ['post_id' => $post1, 'tag_id' => $tagScaloneta],
            ['post_id' => $post2, 'tag_id' => $tagMessi],
            ['post_id' => $post2, 'tag_id' => $tagQatar],
        ]);

     // 6. CREAR COMENTARIOS (Le sacamos el 'estado' para que MySQL no proteste)
        DB::table('comments')->insert([
            [
                'contenido' => '¡Qué gran nota! Me volví a emocionar como el primer día.',
                'user_id' => $espectadorId,
                'post_id' => $post2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'contenido' => '¿Cuándo salen los próximos días de entrenamiento?',
                'user_id' => $espectadorId,
                'post_id' => $post1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'contenido' => 'Este comentario es cualquiera, insultos varios para probar moderación.',
                'user_id' => $espectadorId,
                'post_id' => $post1,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
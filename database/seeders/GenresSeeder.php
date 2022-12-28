<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $generos = [
            'Acción',
            'Aventura',
            'Comedia',
            'Drama',
            'Fantasía',
            'Horror',
            'Ciencia ficción',
            'Thriller',
            'Romance',
            'Slice of life',
            'Deporte',
            'Artes marciales',
            'Supervivencia',
            'Misterio',
            'Psicológico',
            'Familia',
            'Terror',
            'Shoujo',
            'Shounen',
            'Seinen',
            'Josei',
            'Otro',
        ];

        foreach ($generos as $genero) {
            Genre::create([
                'name' => $genero,
            ]);
        }
    }
}

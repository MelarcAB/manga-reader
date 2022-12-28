<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categorias = [
            'Acción',
            'Aventura',
            'Comedia',
            'Drama',
            'Fantasía',
            'Horror',
            'Ciencia ficción',
            'Thriller',
            'Otro',
        ];

        foreach ($categorias as $categoria) {
            Category::create([
                'name' => $categoria,
            ]);
        }
    }
}

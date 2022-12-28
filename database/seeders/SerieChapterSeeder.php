<?php

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Factory;

use Illuminate\Database\Seeder;
use App\Models\Serie;
use App\Models\Chapter;
use App\Models\Genre;
use App\Models\User;

class SerieChapterSeeder extends Seeder
{
    public function run()
    {
        // Crea algunos usuarios
        $users = [
            [
                'name' => 'John Doe',
                'email' => 'john.doe@example.com',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Jane Doe',
                'email' => 'jane.doe@example.com',
                'password' => bcrypt('password'),
            ],
            // Agrega más usuarios si quieres
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }

        // Crea algunas series y asigna un autor aleatorio a cada una
        $seriesData = [
            [
                'name' => 'Serie 1',
                'description' => 'Descripción de la serie 1',
                'author_id' => User::all()->random()->id,
                'number_of_issues' => 10,
                'start_date' => '2020-01-01',
                'end_date' => '2020-12-31',
                'img' => 'serie1.jpg',
            ],
            [
                'name' => 'Serie 2',
                'description' => 'Descripción de la serie 2',
                'author_id' => User::all()->random()->id,
                'number_of_issues' => 20,
                'start_date' => '2021-01-01',
                'end_date' => '2021-12-31',
                'img' => 'serie2.jpg',
            ],
        ];

        foreach ($seriesData as $seriesDatum) {
            Serie::create($seriesDatum);
        }

        // Crea algunos capítulos y asigna una serie y un autor aleatorio a cada uno
        $id_autor = 1;
        $chaptersData = [
            [
                'name' => 'Capítulo 1',
                'description' => 'Descripción del capítulo 1',
                'author_id' => $id_autor,
                'series_id' => Serie::all()->random()->id,
                'issue_number' => 1,
                'release_date' => '2020-01-01',
                'pages' => '[
                    {
                        "url": "https://example.com/page1.jpg",
                        "name": "1.jpg"
                    },
                    {
                        "url": "https://example.com/page2.jpg",
                        "name": "2.jpg"
                    },
                    {
                        "url": "https://example.com/page3.jpg",
                        "name": "3.jpg"
                    }
                ]'
            ],
            [
                'name' => 'Capítulo 2',
                'description' => 'Descripción del capítulo 2',
                'author_id' => $id_autor,
                'series_id' => Serie::all()->random()->id,
                'issue_number' => 2,
                'release_date' => '2020-02-01',
            ],
            [
                'name' => 'Capítulo 3',
                'description' => 'Descripción del capítulo 3',
                'author_id' => $id_autor,
                'series_id' => Serie::all()->random()->id,
                'issue_number' => 3,
                'release_date' => '2020-03-01',
            ],
            [
                'name' => 'Capítulo 4',
                'description' => 'Descripción del capítulo 4',
                'author_id' => $id_autor,
                'series_id' => Serie::all()->random()->id,
                'issue_number' => 4,
                'release_date' => '2020-04-01',
            ],
            // Agrega más capítulos si quieres
        ];

        foreach ($chaptersData as $chaptersDatum) {
            Chapter::create($chaptersDatum);
        }
    }
}

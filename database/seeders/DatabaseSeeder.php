<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(CategoriesSeeder::class);
        $this->call(SocialNetworksSeeder::class);
        $this->call(LanguagesSeeder::class);
        $this->call(GenresSeeder::class);
        // $this->call(SerieChapterSeeder::class);
    }
}

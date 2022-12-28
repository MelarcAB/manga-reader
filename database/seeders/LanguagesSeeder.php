<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Language;

class LanguagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // datos de ejemplo para la tabla "languages"
        $languages = [
            ['name' => 'Español', 'code' => 'es'],
            ['name' => 'Inglés', 'code' => 'en'],
            ['name' => 'Francés', 'code' => 'fr'],
            ['name' => 'Alemán', 'code' => 'de'],
            ['name' => 'Italiano', 'code' => 'it'],
            ['name' => 'Portugués', 'code' => 'pt'],
            ['name' => 'Catalán', 'code' => 'cat'],
        ];

        // inserta los datos de ejemplo en la tabla "languages"
        foreach ($languages as $lang) {
            Language::create([
                'name' => $lang['name'],
                'code' => $lang['code'],
            ]);
        }
    }
}

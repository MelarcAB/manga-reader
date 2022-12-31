<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Helper extends Model
{

    public static function validateNickname($nickname)
    {
        $nickname = strtolower(trim($nickname)); // Convertir a minúsculas y eliminar espacios al principio y final
        $nickname = preg_replace('/[^a-z0-9]/', '', $nickname); // Eliminar caracteres especiales

        // Verificar si el nickname ya existe en la base de datos
        $user = User::where('nickname', $nickname)->first();
        if ($user) {
            // Generar una variante del nickname
            $i = 1;
            while ($user) {
                $newNickname = $nickname . $i;
                $user = User::where('nickname', $newNickname)->first();
                $i++;
            }
            $nickname = $newNickname;
        }

        return $nickname;
    }
}

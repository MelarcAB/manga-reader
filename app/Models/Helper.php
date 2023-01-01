<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Helper extends Model
{

    /**
     * Funcion para verificar que se genera un nickname unico
     * Si existe o es invalido, se generará una variante
     */
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


    /**
     * Esta funcion devolverá los meta tags segun la ruta actual
     * Asi se podrá personalizar el SEO de cada pagina
     */
    public static function getMetaTags($route)
    {
        // Obtener los parámetros de la ruta actual
        $parameters = request()->route()->parameters();

        //default params
        $title = config('app.name', 'Laravel');
        $description = 'Descubre y comparte tus comics y ilustraciones de manga en nuestra plataforma Manganol. Únete a la comunidad y descubre el talento de otros artistas.';
        $keywords = 'mangas, ilustraciones, cómics, dibujantes, arte, manga, español, espanol, españa,autor';
        $robots = 'index, follow';

        $ogtitle = $title;
        $ogdescription = $description;
        $ogimage = asset('img/logo_manganol.svg');
        $ogurl = url()->current();
        $ogsite_name = 'Manganol';
        $ogtype = 'website';
        $oglocale = 'es_ES';

        $twittercard = 'summary';
        $twittertitle = $title;
        $twitterdescription = $description;
        $twitterimage = asset('img/logo_manganol.svg');
        $twitterurl = url()->current();
        $twitterdomain = 'manganol.es';

        switch ($route) {
                // Establecer valores por defecto para los meta tags
            case 'user.public-profile':
                // Obtener el usuario por nickname
                $user = User::where('nickname', $parameters['nickname'])->first();
                if ($user) {
                    // Establecer los meta tags
                    $title = $user->nickname . ' - ' . config('app.name', 'Laravel');
                    $description = "Perfil de " . $user->nickname;
                    $keywords = 'mangas, ilustraciones, cómics, dibujantes, arte, manga, español, espanol, españa,autor';
                    $robots = 'index, follow';

                    $ogtitle = $title;
                    $ogdescription = $description;
                    $ogimage =  asset('storage/users/' . $user->image);
                    $ogurl = url()->current();
                    $ogsite_name = 'Manganol';
                    $ogtype = 'website';
                    $oglocale = 'es_ES';

                    $twittercard = 'summary';
                    $twittertitle = $title;
                    $twitterdescription = $description;
                    $twitterimage =  asset('storage/users/' . $user->image);
                    $twitterurl = url()->current();
                    $twitterdomain = 'manganol.es';
                }
                break;
            case 'serie.show':
                // Obtener la serie por id
                $serie = Serie::find($parameters['id']);
                if ($serie) {
                    // Establecer los meta tags
                    $title = $serie->name . ' - ' . config('app.name', 'Laravel');
                    $description = $serie->description;
                    $keywords = 'mangas, ilustraciones, cómics, dibujantes, arte, manga, español, espanol, españa,autor';
                    $robots = 'index, nofollow';

                    $ogtitle = $title;
                    $ogdescription = $description;
                    $ogimage =   asset('storage/series/' . $serie->id . '/' . $serie->img);
                    $ogurl = url()->current();
                    $ogsite_name = 'Manganol';
                    $ogtype = 'website';
                    $oglocale = 'es_ES';

                    $twittercard = 'summary';
                    $twittertitle = $title;
                    $twitterdescription = $description;
                    $twitterimage =   asset('storage/series/' . $serie->id . '/' . $serie->img);
                    $twitterurl = url()->current();
                    $twitterdomain = 'manganol.es';
                }
                break;
        }

        // Devolver los meta tags en forma de array
        return [
            //seo
            'title' => $title,
            'description' => $description,
            'keywords' => $keywords,
            'robots' => $keywords,

            //social networks 
            //facebook
            "og:title" => $ogtitle,
            "og:description" => $ogdescription,
            "og:image" =>   $ogimage,
            "og:url" => $ogurl,
            "og:site_name" =>   $ogsite_name,
            "og:type" =>    $ogtype,
            "og:locale" =>  $oglocale,
            //twitter
            "twitter:card" =>   $twittercard,
            "twitter:domain" =>   $twitterdomain,
            "twitter:title" =>  $twittertitle,
            "twitter:description" =>   $twitterdescription,
            "twitter:image" =>  $twitterimage,
            "twitter:url" =>    $twitterurl,
            //no hay cuenta de twitter :(
            //"twitter:site" => '@manganol',
            // "twitter:creator" => '@manganol',

        ];
    }
}

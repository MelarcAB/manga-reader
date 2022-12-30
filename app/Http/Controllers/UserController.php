<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use App\Models\Chapter;
use App\Models\Genre;
use App\Models\SocialNet;
use App\Models\UserSocialNet;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class UserController extends Controller
{


    function __construct()
    {
        $this->middleware('auth');
    }

    public function publicaciones()
    {
        //filtrar series por usuario 
        $series = Serie::where('author_id', auth()->user()->id)->get();
        return view('user.publicaciones.details', compact('series'));
    }

    function publicacion($id = null)
    {
        if ($id) {
            $serie = Serie::findOrFail($id);
        } else {
            $serie = new Serie();
        }

        //obtener generos
        $genres = Genre::all();

        return view('user.publicaciones.form', compact('serie', 'genres'));
    }


    public function manageChapters($id)
    {
        $serie = Serie::findOrFail($id);

        //chapters
        $chapters = $serie->chapters;


        return view('user.publicaciones.management', compact('serie', 'chapters'));
    }

    public function deleteChapter($id)
    {
        $chapter = Chapter::findOrFail($id);
        $serie = Serie::findOrFail($chapter->series_id);

        //comprobamos que el usuario es el autor de la serie
        if ($serie->author_id !== auth()->user()->id) {
            return back()->withErrors(['No tienes permiso para eliminar capítulos de esta serie']);
        }

        $chapter->delete();

        return back()->with('success', 'Capítulo eliminado correctamente');
    }

    public function uploadChapter($id = 0, $idchapter = 0)
    {
        //comprobamos que el usuario es el autor de la serie
        $serie = Serie::findOrFail($id);
        if ($serie->author_id !== auth()->user()->id) {
            return back()->withErrors(['No tienes permiso para subir capítulos a esta serie']);
        }

        if ($idchapter) {
            $chapter = Chapter::findOrFail($idchapter);
        } else {
            $chapter = new Chapter();
        }

        return view('user.publicaciones.form-chapter', compact('serie', 'chapter'));
    }


    public function destroyPublication($id)
    {
        // Obtener el usuario autenticado
        $user = auth()->user();

        // Obtener la serie a eliminar
        $serie = Serie::findOrFail($id);

        // Verificar si el usuario autenticado es el autor de la serie
        if ($serie->author_id !== $user->id) {
            // Redirigir al usuario a la página anterior con un mensaje de error
            return back()->withErrors(['No tienes permiso para eliminar esta serie']);
        }

        $serie->delete();
        return redirect()->route('user.publicaciones');
    }

    public function storePublication(Request $request)
    {


        // Validar la petición
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'number_of_issues' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'img' => 'nullable|image',
        ]);

        //si existe el campo serie_id es que se está editando
        if ($request->serie_id && $request->serie_id !== null) {

            $serie = Serie::findOrFail($request->serie_id);
            //comprobamos que el usuario es el autor de la serie
            if ($serie->author_id !== auth()->user()->id) {
                return back()->withErrors(['No tienes permiso para editar esta serie']);
            }
            $serie->name = $request->name;
            $serie->description = $request->description;
            $serie->number_of_issues = $request->number_of_issues;
            $serie->start_date = $request->start_date;
            $serie->end_date = $request->end_date;
            if ($request->genres) {
                $serie->genres()->detach();
                $serie->genres()->attach($request->input('genres'));
            } else {
                $serie->genres()->detach();
            }
            $serie->save();

            //si se ha subido una imagen nueva, se borra la anterior y se guarda la nueva
            if ($request->img) {
                //borramos la imagen anterior
                unlink(storage_path('app/public/series/' . $serie->id . '/' . $serie->img));
                //subimos la nueva imagen
                $request->img->storeAs('public/series/' . $serie->id, $serie->id . '.' . $request->img->extension());
                //si se ha subido la imagen, se guarda la ruta en la base de datos campo img
                $serie->img =  $serie->id . '.' . $request->img->extension();
                $serie->save();
            }
            return redirect()->route('user.edit-publicacion', ['id' => $serie->id]);
        }

        // Obtener el usuario autenticado
        $user = $user = auth()->user();



        // Crear una nueva serie con los datos del request
        $serie = new Serie([
            'name' => $request->name,
            'description' => $request->description,
            'number_of_issues' => $request->number_of_issues,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);
        //si tiene genres seleccionados, se guardan 


        // Asignar el usuario como autor de la serie
        $serie->author_id = $user->id;


        // Almacenar la serie en la base de datos
        $serie->save();
        if ($request->genres) {
            $serie->genres()->attach($request->input('genres'));
        }
        // Subir la imagen de la serie a storage/app/public/series/ID
        //  $request->img->storeAs('series', $serie->id . '.' . $request->img->extension());
        $request->img->storeAs('public/series/' . $serie->id, $serie->id . '.' . $request->img->extension());
        //si se ha subido la imagen, se guarda la ruta en la base de datos campo img
        $serie->img =  $serie->id . '.' . $request->img->extension();
        $serie->save();

        // Redirigir a la vista de detalles de la serie creada
        return redirect()->route('serie.show', ['id' => $serie->id]);
    }

    public function manageAccountView()
    {
        return view('user.gestion.cuenta');
    }

    public function manageProfileView()
    {
        $user = auth()->user();
        //obtener redes sociales del usuario
        $userSocialNets = [];
        $userSocialNetRecords = DB::table('user_socialnet')->where('user_id', $user->id)->get();
        foreach ($userSocialNetRecords as $record) {
            $userSocialNets[$record->socialnet_id] = $record->url;
        }
        $socialNets = SocialNet::all();

        return view('user.gestion.perfil', compact('socialNets', 'userSocialNets'));
    }

    public function updateAccountInfo(Request $request)
    {
        // Validate form data
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Get current user
        $user = $user = auth()->user();

        // Check if a new image was uploaded
        if ($request->hasFile('image')) {
            // Delete old image from storage


            // Save new image to storage and update user's image field in database
            $image = $request->file('image');
            $image_path = $image->storeAs("public/users", $user->id . '.' . $image->getClientOriginalExtension());
            $user->image = $user->id . '.' . $image->getClientOriginalExtension();
            $user->save();
        }

        // Show success message or redirect to public profile page
        return redirect()->route('user.manage-account')->with('success', 'Perfil actualizado con éxito');
    }

    public function updateProfileInfo(Request $request)
    {
        //camps name y description
        // Validate form data
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
        ]);

        // Get current user
        $user = $user = auth()->user();

        // Update user's name and description
        $user->name = $request->name;
        $user->description = $request->description;


        $user->save();
        // Obtener el array de redes sociales del formulario
        $socialNets = $request->input('social_nets');

        //limpiar las relaciones actualmente existentes
        $user->socialNets()->detach();


        foreach ($socialNets as $socialNetId => $socialNetUrl) {
            // Aquí puedes hacer lo que necesites con cada red social, por ejemplo:
            // - eliminar todas las redes sociales del usuario
            //si es null continuar
            if ($socialNetUrl == null) {
                continue;
            }

            $userSocialNet = new UserSocialNet;
            $userSocialNet->socialnet_id = $socialNetId;
            $userSocialNet->user_id = $user->id;

            // Actualizar la URL de la red social
            $userSocialNet->url = $socialNetUrl;
            $userSocialNet->save();
        }


        // Show success message or redirect to public profile page
        return redirect()->route('user.manage-profile')->with('success', 'Perfil actualizado con éxito');
    }
}

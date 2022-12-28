<?php

namespace App\Http\Controllers;

use App\Models\Serie;

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

    function publicacion()
    {
        return view('user.publicaciones.form');
    }

    public function manageChapters($id)
    {
        $serie = Serie::findOrFail($id);

        //chapters
        $chapters = $serie->chapters;


        return view('user.publicaciones.management', compact('serie', 'chapters'));
    }

    public function uploadChapter($id)
    {
        //comprobamos que el usuario es el autor de la serie
        $serie = Serie::findOrFail($id);
        if ($serie->author_id !== auth()->user()->id) {
            return back()->withErrors(['No tienes permiso para subir capítulos a esta serie']);
        }

        return view('user.publicaciones.form-chapter', compact('serie'));
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
            'img' => 'required|image',
        ]);

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

        // Asignar el usuario como autor de la serie
        $serie->author_id = $user->id;


        // Almacenar la serie en la base de datos
        $serie->save();

        // Subir la imagen de la serie a storage/app/public/series/ID
        //  $request->img->storeAs('series', $serie->id . '.' . $request->img->extension());
        $request->img->storeAs('public/series/' . $serie->id, $serie->id . '.' . $request->img->extension());
        //si se ha subido la imagen, se guarda la ruta en la base de datos campo img
        $serie->img =  $serie->id . '.' . $request->img->extension();
        $serie->save();

        // Redirigir a la vista de detalles de la serie creada
        return redirect()->route('serie.show', ['id' => $serie->id]);
    }
}

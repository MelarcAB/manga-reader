<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Serie;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validar el formulario

        //si existe chapter_id, se edita el capítulo
        if ($request->chapter_id != null) {
            $chapter = Chapter::find($request->chapter_id);
            //verificar que el usuario autenticado es el autor de la serie
            $serie = Serie::find($chapter->series_id);
            if ($serie->author_id != auth()->user()->id) {
                return redirect()->route('main');
            }
            //actualizar datos
            $chapter->name = $request->name;
            $chapter->description = $request->description;
            $chapter->issue_number = $request->issue_number;
            $chapter->release_date = $request->release_date;
            // Procesar las páginas del capítulo
            //se eliminan las páginas anteriores y se agregan las nuevas
            if ($request->hasFile('pages')) {
                $pages = [];
                //crear el directorio si no existe
                foreach ($request->pages as $page) {
                    $path = $page->move('storage/series/' . $chapter->series_id . "/" . "chapters/" . $chapter->id, $page->getClientOriginalName());
                    $pages[] = [
                        'name' => $page->getClientOriginalName(),
                        'path' => $path,
                    ];
                }
                //convertir pages a json
                $pages = json_encode($pages);
                $chapter->pages = $pages;
            }

            // Guardar el capítulo
            $chapter->save();
            // Redirigir al usuario a la lista de capítulos
            return redirect()->route('publication.uploadeditchapter', ['id' => $chapter->series_id, 'idchapter' => $chapter->id]);
        }

        // Crear un nuevo chapter
        $chapter = new Chapter;
        $chapter->name = $request->name;
        $chapter->description = $request->description;
        // $chapter->author_id = $request->author_id;
        $chapter->series_id = $request->series_id;
        $chapter->issue_number = $request->issue_number;
        $chapter->release_date = $request->release_date;

        //el author_id se obtiene del usuario autenticado
        $chapter->author_id = auth()->user()->id;
        //series_id se obtiene de la serie seleccionada
        $chapter->series_id = $request->serie_id;
        //verificar que la serie seleccionada pertenezca al usuario autenticado
        $serie = Serie::find($request->serie_id);
        if ($serie->author_id != auth()->user()->id) {
            return redirect()->route('main');
        }
        $chapter->save();

        // Procesar las páginas del capítulo
        if ($request->hasFile('pages')) {
            $pages = [];
            //crear el directorio si no existe
            foreach ($request->pages as $page) {
                $path = $page->move('storage/series/' . $chapter->series_id . "/" . "chapters/" . $chapter->id, $page->getClientOriginalName());
                $pages[] = [
                    'name' => $page->getClientOriginalName(),
                    'path' => $path,
                ];
            }
            //convertir pages a json
            $pages = json_encode($pages);
            $chapter->pages = $pages;
        }


        // Guardar el capítulo
        $chapter->save();
        // Redirigir al usuario a la lista de capítulos
        return redirect()->route('chapter.pages', ['id' => $chapter->id]);
    }

    public function showPages($id)
    {
        // Obtener el capítulo por su id
        $chapter = Chapter::find($id);
        //obtener capitulo anterior y siguiente
        $previousChapter = $chapter->previousChapter();
        $nextChapter = $chapter->getNextChapter();

        // Mostrar la vista de las páginas del capítulo
        return view('chapter.show', compact('chapter', 'previousChapter', 'nextChapter'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function show(Chapter $chapter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function edit(Chapter $chapter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chapter $chapter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chapter $chapter)
    {
        //
    }
}

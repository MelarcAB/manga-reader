<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
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
        // Crear un nuevo chapter
        $chapter = new Chapter;
        $chapter->name = $request->name;
        $chapter->description = $request->description;
        $chapter->author_id = $request->author_id;
        $chapter->series_id = $request->series_id;
        $chapter->issue_number = $request->issue_number;
        $chapter->release_date = $request->release_date;

        // Procesar las páginas del capítulo
        if ($request->hasFile('pages')) {
            $pages = [];
            foreach ($request->pages as $page) {
                $path = $page->move('storage/series/' . $request->series_id . '/chapters/' . $chapter->id, $page->getClientOriginalName());
                $pages[] = [
                    'name' => $page->getClientOriginalName(),
                    'path' => $path,
                ];
            }
            $chapter->pages = $pages;
        }

        // Guardar el capítulo
        $chapter->save();
        // Redirigir al usuario a la lista de capítulos
        return redirect()->route('chapters.index');
    }

    public function showPages($id)
    {
        // Obtener el capítulo por su id
        $chapter = Chapter::find($id);

        // Mostrar la vista de las páginas del capítulo
        return view('chapter.show', compact('chapter'));
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

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
}

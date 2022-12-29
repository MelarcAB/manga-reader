<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Serie;
use App\Models\Chapter;

class HomePublicController extends Controller
{
    public function index()
    {
        $series = Serie::all();
        $latestChapters = Chapter::orderBy('release_date', 'desc')->take(5)->get();
        return view('index')->with('series', $series)->with('latestChapters', $latestChapters);
    }
}

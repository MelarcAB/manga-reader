<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Serie;

class HomePublicController extends Controller
{
    public function index()
    {
        $series = Serie::all();
        return view('index')->with('series', $series);
    }
}

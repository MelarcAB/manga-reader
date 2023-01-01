<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Serie;
use App\Models\User;
use App\Models\Chapter;
use App\Models\SocialNet;
use Illuminate\Support\Facades\DB;



class HomePublicController extends Controller
{
    public function index()
    {
        $series = Serie::all();
        $latestChapters = Chapter::orderBy('release_date', 'desc')->take(5)->get();
        return view('index')->with('series', $series)->with('latestChapters', $latestChapters);
    }

    public function showPublicProfile($nickname = null)
    {
        if ($nickname == null) {
            return redirect()->route('home');
        }

        $user = User::where('nickname', $nickname)->firstOrFail();
        $series = Serie::where('author_id', $user->id)->get();
        //social networks
        $socialNets = $user->socialNets;
        return view('user.public.profile', compact('user', 'series', 'socialNets'));
    }

    public function search(Request $request)
    {

        //obtener busqueda
        $q = $request->input('q');



        //si la busqueda es vacia, redirigir a home
        if ($q == "") {
            return redirect()->route('home');
        }
        $search = DB::raw('%' . $q . '%');

        $series = Serie::where('name', 'like', '%' . $search . '%')
            ->orWhere('description', 'like', '%' . $search . '%')
            ->orWhereHas('chapters', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            })
            ->orWhereHas('author', function ($query) use ($search) {
                $query->where('nickname', 'like', '%' . $search . '%');
            })
            ->get();

        return view('serie.search', compact('series', 'q'));
    }
}

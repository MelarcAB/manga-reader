<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Serie;
use App\Models\User;
use App\Models\Chapter;
use App\Models\SocialNet;

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
        $socialNets = $user->social_nets;
        return view('user.public.profile', compact('user', 'series', 'socialNets'));
    }
}

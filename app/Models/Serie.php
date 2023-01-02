<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Chapter;
use App\Models\Language;
use Auth;

class Serie extends Model
{
    protected $fillable = [
        'name', 'number_of_issues', 'start_date', 'end_date', 'img', 'description'
    ];
    protected $attributes = [
        'number_of_issues' => 0,
    ];

    use HasFactory;

    public function author()
    {
        return $this->belongsTo('App\Models\User', 'author_id');
    }

    public function chapters()
    {
        return $this->hasMany(Chapter::class, 'series_id')->orderBy('issue_number', 'asc');
    }
    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }


    public function users()
    {
        return $this->belongsToMany(User::class, 'users_series', 'serie_id', 'user_id');
    }
    public function followers()
    {
        return $this->belongsToMany(User::class, 'users_suscriptions', 'serie_id', 'user_id');
    }


    public function getGenresNames()
    {
        $genres = $this->genres;
        $genresNames = [];
        foreach ($genres as $genre) {
            $genresNames[] = $genre->name;
        }
        return $genresNames;
    }
    public function isFollowing()
    {
        $user = Auth::user();
        if ($user) {
            $following = $user->suscriptions()->where('serie_id', $this->id)->first();
            return $following != null;
        }
        return false;
    }
}

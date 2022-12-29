<?php

namespace App\Models;

use App\Models\Serie;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    public function pages()
    {
        $pages = json_decode($this->pages, true);

        if (is_array($pages) && count($pages) > 0) {
            return $pages;
        }

        return [];
    }

    function serie()
    {
        return $this->belongsTo('App\Models\Serie', 'series_id');
    }
}

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


    public function getNextChapter()
    {
        return self::where('series_id', $this->series_id)
            ->where('issue_number', '>', $this->issue_number)
            ->orderBy('issue_number', 'asc')
            ->first();
    }

    public function previousChapter()
    {
        return self::where('series_id', $this->series_id)
            ->where('issue_number', '<', $this->issue_number)
            ->orderBy('issue_number', 'desc')
            ->first();
    }
}

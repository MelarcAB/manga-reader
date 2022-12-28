<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Chapter;

class Serie extends Model
{
    use HasFactory;

    public function author()
    {
        return "test";
    }

    public function chapters()
    {
        return $this->hasMany(Chapter::class, 'series_id')->orderBy('issue_number', 'asc');
    }
}

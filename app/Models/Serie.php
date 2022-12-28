<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Chapter;

class Serie extends Model
{
    protected $fillable = [
        'name', 'number_of_issues', 'start_date', 'end_date', 'img', 'description', 'author_id'
    ];
    protected $attributes = [
        'number_of_issues' => 0,
    ];

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

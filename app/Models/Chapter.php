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
        return json_decode($this->pages, true);
    }
}

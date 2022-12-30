<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SocialNet;
use App\Models\User;

class UserSocialNet extends Model
{

    use HasFactory;
    protected $table = 'user_socialnet';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

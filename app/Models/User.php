<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Models\SocialNet;
use App\Models\UserSocialNet;

class User extends Authenticatable implements JWTSubject
{
    /**
     * @melarc.ab
     *  Por ahora 3 tipos de usuarios
     *  1- Usuario web
     *  2- Usuario "moderador"
     *  3- Usuario "administrador"
     */

    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'nickname',
        'image',
        'description',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /**
     * Obtén el identificador único para el usuario.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Obtén un array de claims personalizados para incluir en el JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function socialNets()
    {
        // return $this->belongsToMany(SocialNet::class, 'user_socialnet', 'user_id', 'socialnet_id');
        return $this->belongsToMany(SocialNet::class, 'user_socialnet', 'user_id', 'socialnet_id')->withPivot('url');
    }
}

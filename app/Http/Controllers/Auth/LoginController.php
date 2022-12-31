<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use Google_Client;
use Google_Service_Oauth2;
use App\Models\User;
use App\Models\Helper;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        // Obtener los datos del usuario desde Google
        $googleUser = Socialite::driver('google')->user();

        // Verificar si el usuario ya existe en la base de datos por email
        $user = User::where('email', $googleUser->email)->first();

        if ($user) {
            // Si el usuario ya existe, actualizar su google_id y iniciar sesión
            $user->google_id = $googleUser->id;
            $user->save();
            Auth::login($user);
        } else {
            // Si el usuario no existe, crear un nuevo usuario con los datos de Google y iniciar sesión
            $user = new User();
            $user->name = $googleUser->name;
            $user->nickname = Helper::validateNickname($googleUser->name);
            $user->email = $googleUser->email;
            $user->google_id = $googleUser->id;
            $user->password = bcrypt(bin2hex(random_bytes(4)));

            $user->save();
            Auth::login($user);
        }

        return redirect()->route('home');
    }
}

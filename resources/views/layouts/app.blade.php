@php
use App\Models\Helper;
$metaTags = Helper::getMetaTags(Route::currentRouteName());
echo Route::currentRouteName()."<br>";
@endphp
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--meta tags-->

    <title>{{ $metaTags['title'] }}</title>
    <meta name="description" content="{{ $metaTags['description'] }}">
    <meta name="keywords" content="{{ $metaTags['keywords'] }}">

    <meta property="og:url" content="{{ $metaTags['og:url'] }}">
    <meta property="og:title" content="{{ $metaTags['og:title'] }}">
    <meta property="og:description" content="{{ $metaTags['og:description'] }}">
    <meta property="og:image" content="{{ $metaTags['og:image'] }}">
    <meta property="og:site_name" content="{{ $metaTags['og:site_name'] }}">
    <meta property="og:type" content="{{ $metaTags['og:type'] }}">
    <meta property="og:locale" content="{{ $metaTags['og:locale'] }}">

    <meta name="twitter:card" content="{{ $metaTags['twitter:card'] }}">
    <meta property="twitter:domain" content="{{ $metaTags['twitter:domain'] }}">
    <meta property="twitter:url" content="{{ $metaTags['twitter:url'] }}">
    <meta name="twitter:title" content="{{ $metaTags['twitter:title'] }}">
    <meta name="twitter:description" content="{{ $metaTags['twitter:description'] }}">
    <meta name="twitter:image" content="{{ $metaTags['twitter:image'] }}">

    <!-- end meta tags -->



    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/logo-min.ico') }}">


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <link href="{{ asset('css/index.css') }}" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />


</head>

<body class="d-flex flex-column">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light  shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('img/logo_manganol.svg') }}" alt="Logo de mi sitio" style="width: 200px;">
                </a>


                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <img src="{{ asset('storage/users/'.Auth::user()->image) }}" alt="Imagen de perfil" class="rounded-circle" style="width: 30; height: 30px;">
                                {{ Auth::user()->nickname }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('user.public-profile',['nickname'=>Auth::user()->nickname]) }}">
                                    Perfil
                                </a>
                                <a class="dropdown-item" href="{{ route('user.publicaciones') }}">
                                    Publicacioens
                                </a>
                                <a class="dropdown-item" href="{{ route('user.manage-account') }}">
                                    Gestionar cuenta
                                </a>

                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>

                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="flex-grow-1" style="padding: 15px;">
            @yield('content')
        </main>
    </div>
    @include('layouts/footer')

</body>
<script src="{{ asset('js/test.js') }}"></script>


</html>
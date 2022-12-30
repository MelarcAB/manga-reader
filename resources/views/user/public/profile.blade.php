@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-3">
            <img src="{{ asset('storage/users/'.$user->image) }}" alt="Imagen de perfil" class="img-thumbnail img-fluid" style="max-width: 100%;">
        </div>
        <div class="col-8">
            <h1>{{ $user->nickname }}</h1>
            <p>{!! nl2br($user->description) !!}</p>
            <ul>
                REDES SOCIALES
                @foreach($socialNets as $social_network)
                <li><a href="{{ $social_network->url }}">{{ $social_network->name }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
    <hr>
    <h2>Publicaciones de {{ $user->nickname }}</h2>
    <div class="row mt-3">
        @foreach($series as $serie)
        <div class="col-3">
            <a href="{{ route('serie.show', $serie->id) }}">
                <img src="{{ asset('storage/series/'.$serie->id.'/'.$serie->img) }}" alt="Imagen de la serie" class="img-thumbnail img-fluid" style="max-width: 100%;">
                <h3>{{ $serie->name }}</h3>
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection
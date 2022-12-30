@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-4">
            <img src="{{ asset('storage/users/'.$user->id.'/'.$user->img) }}" alt="Imagen de perfil" class="img-thumbnail" style="width: 100%">
        </div>
        <div class="col-8">
            <h1>{{ $user->name }}</h1>
            <p>{{ $user->description }}</p>
        </div>
    </div>
    <hr>
    <h2>Publicaciones de {{ $user->name }}</h2>
    <div class="row mt-3">
        @foreach($series as $serie)
        <div class="col-3">
            <a href="{{ route('serie.show', $serie->id) }}">
                <img src="{{ asset('storage/series/'.$serie->id.'/'.$serie->img) }}" alt="Imagen de la serie" class="img-thumbnail" style="width: 100%">
                <h3>{{ $serie->name }}</h3>
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container palette-container">
    <div class="row">
        <div class="col-md-3">
            <img src="{{ asset('storage/series/'.$serie->id.'/'.$serie->img) }}" class="img-fluid" alt="Imagen de la serie">
            @if (Auth::check())
            @if ($serie->isFollowing())
            <p>Ya estás siguiendo esta serie. </p>
            <form action="{{ route('serie.unfollow',['serie_id'=>$serie->id]) }}" method="POST">
                @csrf
                <input type="hidden" name="serie_id" value="{{ $serie->id }}">
                <button type="submit" class="btn btn-primary">Dejar de seguir</button>
            </form>
            @else
            <form action="{{ route('serie.follow',['serie_id'=>$serie->id]) }}" method="POST">
                @csrf
                <input type="hidden" name="serie_id" value="{{ $serie->id }}">
                <button type="submit" class="btn btn-primary">Seguir serie</button>
            </form>
            @endif
            @else
            <p>Para seguir esta serie, debes <a href="{{ route('login') }}">iniciar sesión</a>.</p>
            @endif


        </div>
        <div class="col-md-9">
            <h1>{{ $serie->name }}</h1>
            <p>{{ $serie->description }}</p>
            <table class="table table-borderless">
                <tbody>
                    <tr>
                        <th>Autor</th>
                        <td>
                            <a href="{{route('user.public-profile',['nickname'=>$serie->author->nickname])}}">
                                <i class="fa fa-user"></i> {{ $serie->author->nickname }}</a>
                        </td>
                    </tr>
                    <tr>
                        <th>Número de capítulos</th>
                        <td>{{count( $serie->chapters) }}</td>
                    </tr>
                    <tr>
                        <th>Fecha de inicio</th>
                        <td>{{ $serie->start_date }}</td>
                    </tr>
                    @if ($serie->end_date)
                    <tr>
                        <th>Fecha de finalización</th>
                        <td>{{ $serie->end_date }}</td>
                    </tr>
                    @endif
                    <tr>
                        <th>Idioma</th>
                        <td>{{ $serie->language->name }}</td>
                    </tr>
                    <tr>
                        <th>Géneros</th>
                        <td>{{ implode(', ', $serie->getGenresNames()) }}</td>
                    </tr>
                    <tr>
                        <th>Personas siguiendo esta serie</th>
                        <td>{{ count( $serie->followers) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <hr>
    <h2>Capítulos</h2>
    <div class="row">
        @foreach ($serie->chapters as $chapter)
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm card-no-border card-body-color-custom">
                <div class="card-body card-body-color-custom">
                    <h5 class="card-title" style="margin-bottom: 10px;">{{ $chapter->issue_number }} : {{ $chapter->name }}</h5>
                    <p class="card-text" style="margin-bottom: 5px;">{{ $chapter->description }}</p>
                    <p style="margin-bottom: 5px;">Número de capítulo: {{ $chapter->issue_number }}</p>
                    <p style="margin-bottom: 5px;">Fecha de lanzamiento: {{ $chapter->release_date }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{route('chapter.pages',['id'=>$chapter->id])}}" class="btn btn-primary" style="margin-top: 10px;">Leer</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>



</div>
@endsection
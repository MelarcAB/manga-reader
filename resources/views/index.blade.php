@extends('layouts.app')
@section('content')
<div class="container palette-container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1>Series</h1>
            <div class="row">
                @foreach ($series as $serie)

                <div class="col-md-3">
                    <div class="card mb-4 shadow-sm card-no-border">
                        <div class="card-img-top-container position-relative">
                            <img src="{{ asset('storage/series/'.$serie->id.'/'.$serie->img) }}" class="card-img-top" alt="Imagen de la serie">
                            <div class="dark-overlay">
                                <a href="{{route('serie.show',['id'=>$serie->id])}}">
                                    <h5 class="card-title text-center" style="padding-top: 5px;">{{ $serie->name }}</h5>
                                </a>
                                <p>Capítulos: {{ count($serie->chapters) }}</p>
                                <p>Capítulos: {{ count($serie->chapters) }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="{{route('serie.show',['id'=>$serie->id])}}" class="btn btn-primary btn-block">Ver más</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="container mt-5 palette-container">
    <h2>Últimos capítulos publicados</h2>
    <div class="row">
        @foreach ($latestChapters as $chapter)
        <div class="col-md-2 ">
            <div class="card mb-2 shadow-sm">
                <div class="card-img-top-container-lt">
                    <img src="{{ asset('storage/series/'.$chapter->serie->id.'/'.$chapter->serie->img) }}" class="card-img-top" alt="Imagen de la serie">
                </div>
                <div class="card-body custom-last-chapters">
                    <h6 class="card-title text-center">{{$chapter->serie->name}}</h6>
                    <h5 class="card-title text-center">Capítulo {{$chapter->issue_number}}</h5>
                    <h6 class="card-title text-center"> {{ $chapter->name }}</h6>
                    <p>Autor: {{ $chapter->serie->author->name }}</p>
                    <p>Fecha: {{ $chapter->release_date }}</p>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{route('chapter.pages',['id'=>$chapter->id])}}" class="btn btn-primary btn-block">Ver más</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
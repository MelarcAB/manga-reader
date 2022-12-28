@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1>Series</h1>
            <div class="row">
                @foreach ($series as $serie)
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-img-top-container">
                            <img src="{{ asset('storage/series/'.$serie->id.'/'.$serie->img) }}" class="card-img-top" alt="Imagen de la serie">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title text-center">{{ $serie->name }}</h5>
                            <p class="card-text">{{ $serie->description }}</p>
                            <p>Número de capítulos: {{ $serie->number_of_issues }}</p>
                            <p>Fecha de inicio: {{ $serie->start_date }}</p>
                            @if ($serie->end_date)
                            <p>Fecha de finalización: {{ $serie->end_date }}</p>
                            @endif
                            <p>Autor: {{ $serie->author->name }}</p>
                            <div class="card-footer">
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
@endsection
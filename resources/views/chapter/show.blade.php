@extends('layouts.app')

@section('content')

<div class="container">
    <div style="text-align: center;">
        <h2>{{ $chapter->serie->name }}</h2>
        <h3>Capítulo: {{ $chapter->issue_number }}</h3>
        <h2>{{ $chapter->name }}</h2>
        <div class="col-md-3" style="margin: auto;margin-top:10px;text-align:center">
            @if(!empty($previousChapter))
            <a href="{{ route('chapter.pages', $previousChapter->id) }}" class="btn btn-secondary btn-block mt-2">Capítulo anterior</a>
            @endif
            @if(!empty($nextChapter))
            <a href="{{ route('chapter.pages', $nextChapter->id) }}" class="btn btn-secondary btn-block mt-2">Siguiente capítulo</a><br>
            @endif
            <br>

        </div>
    </div>

    @if(count($chapter->pages())>0)
    @foreach ($chapter->pages() as $page)
    <img src="{{ asset('storage/series/'.$chapter->series_id.'/chapters/'.$chapter->id.'/'.$page['name']) }}" class="mx-auto d-block img-fluid" alt="{{ $page['name'] }}">
    @endforeach
    @else
    <p>Error al cargar páginas</p>

    @endif
    <div class="col-md-3" style="margin: auto;margin-top:10px;text-align:center">
        @if(!empty($previousChapter))
        <a href="{{ route('chapter.pages', $previousChapter->id) }}" class="btn btn-secondary btn-block mt-2">Capítulo anterior</a>
        @endif
        @if(!empty($nextChapter))
        <a href="{{ route('chapter.pages', $nextChapter->id) }}" class="btn btn-secondary btn-block mt-2">Siguiente capítulo</a><br>
        @endif
        <br>
        <a href="{{ route('serie.show', $chapter->series_id) }}" class="btn btn-primary btn-block mt-4">Volver al listado de capítulos</a>
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Información del capítulo</h5>
                <p>Autor: {{ $chapter->serie->author->name }}</p>
                <p>Fecha de publicación: {{ $chapter->release_date }}</p>
            </div>
        </div>

    </div>

</div>
@endsection
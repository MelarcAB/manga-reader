<?php

use Carbon\Carbon;

$today = Carbon::now()->toDateString();
?>
@extends('layouts.app')

@section('content')


<div class="container mt-2">

    @if (isset($chapter->id))
    <h2>Editar capítulo</h2>
    @else
    <h2>Subir capítulo</h2>
    @endif


    <p>Serie: {{ $serie->name }}</p>
    <form action="{{route('chapter.store')}}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="serie_id" value="{{ $serie->id }}">
        <input type="hidden" name="chapter_id" value="{{ $chapter->id }}">
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" value="{{$chapter->name}}">
        </div>
        <div class="form-group">
            <label for="description">Descripción</label>
            <textarea class="form-control" id="description" name="description">{{$chapter->description}}</textarea>
        </div>
        <div class="form-group">
            <label for="issue_number">Número de capítulo</label>
            <input type="number" class="form-control" id="issue_number" name="issue_number" value="{{$chapter->issue_number}}">
        </div>
        <div class="form-row">
            <div class="col-5" style="display: inline-block;">
                <label for="release_date">Fecha de publicación</label>
                <input type="date" class="form-control" id="release_date" name="release_date" value="{{$chapter->release_date??$today}}">
            </div>
            <div class="col-5" style="display: inline-block;">
                <label for="pages">Páginas</label>
                <input type="file" class="form-control" id="pages" name="pages[]" multiple>
            </div>
        </div>
        <br>
        @if (isset($chapter->id))
        <button type="submit" class="btn btn-primary">Editar</button>
        @else
        <button type="submit" class="btn btn-primary">Subir</button>
        @endif
    </form>
</div>

@endsection
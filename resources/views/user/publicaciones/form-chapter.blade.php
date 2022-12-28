@extends('layouts.app')

@section('content')
<div class="container mt-2">
    <h2>Subir capítulos</h2>
    <p>Serie: {{ $serie->name }}</p>
    <form action="" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="serie_id" value="{{ $serie->id }}">

        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        <div class="form-group">
            <label for="description">Descripción</label>
            <textarea class="form-control" id="description" name="description"></textarea>
        </div>
        <div class="form-group">
            <label for="issue_number">Número de tomo</label>
            <input type="number" class="form-control" id="issue_number" name="issue_number">
        </div>
        <div class="form-group">
            <label for="release_date">Fecha de publicación</label>
            <input type="date" class="form-control" id="release_date" name="release_date">
        </div>
        <div class="form-group">
            <label for="pages">Páginas</label>
            <input type="file" class="form-control" id="pages" name="pages[]" multiple>
        </div>
        <button type="submit" class="btn btn-primary">Subir</button>
    </form>
</div>

@endsection
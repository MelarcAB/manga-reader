@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Crear nueva serie</h1>
    <form action="{{route('user.store-publicacion')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $serie->name }}">
        </div>
        <div class="form-group">
            <label for="description">Descripción</label>
            <textarea name="description" id="description" class="form-control">{{ $serie->description }}</textarea>
        </div>

        <input type="hidden" name="number_of_issues" id="number_of_issues" class="form-control" value="1">
        <div class="form-group">
            <label for="start_date">Fecha de inicio</label>
            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $serie->start_date }}">
        </div>
        <div class="form-group">
            <label for="end_date">Fecha de finalización (opcional)</label>
            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $serie->end_date }}">
        </div>
        <div class="form-group">
            <label for="img">Imagen de la serie</label>
            <input type="file" name="img" id="img" class="form-control-file">
        </div>
        <input type="hidden" name="serie_id" value="{{ $serie->id }}">

        @if($serie->id != null)
        <button type="submit" class="btn btn-primary">Editar</button>
        @else
        <button type="submit" class="btn btn-primary">Crear</button>
        @endif

    </form>
</div>
@endsection
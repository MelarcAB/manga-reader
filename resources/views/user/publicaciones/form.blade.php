@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Crear nueva serie</h1>
    <form action="{{route('user.store-publicacion')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label for="description">Descripción</label>
            <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label for="number_of_issues">Número de tomos</label>
            <input type="number" name="number_of_issues" id="number_of_issues" class="form-control" value="{{ old('number_of_issues') }}">
        </div>
        <div class="form-group">
            <label for="start_date">Fecha de inicio</label>
            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date') }}">
        </div>
        <div class="form-group">
            <label for="end_date">Fecha de finalización (opcional)</label>
            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date') }}">
        </div>
        <div class="form-group">
            <label for="img">Imagen de la serie</label>
            <input type="file" name="img" id="img" class="form-control-file">
        </div>
        <button type="submit" class="btn btn-primary">Crear</button>
    </form>
</div>
@endsection
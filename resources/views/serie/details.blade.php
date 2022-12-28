@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <img src="{{ asset('storage/series/'.$serie->img) }}" class="img-fluid" alt="Imagen de la serie">
            <p class="text-muted font-weight-bold mt-2">Imagen de la serie</p>
        </div>
        <div class="col-md-9">
            <h1>{{ $serie->name }}</h1>
            <p>{{ $serie->description }}</p>
            <table class="table table-borderless">
                <tbody>
                    <tr>
                        <th>Autor</th>
                        <td>{{ $serie->author() }}</td>
                    </tr>
                    <tr>
                        <th>Número de tomos</th>
                        <td>{{ $serie->number_of_issues }}</td>
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
                </tbody>
            </table>
        </div>
    </div>
    <hr>
    <h2>Capítulos</h2>
    <div class="row">

        @foreach ($serie->chapters as $chapter)
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">{{ $chapter->name }}</h5>
                    <p class="card-text">{{ $chapter->description }}</p>
                    <p>Número de capítulo: {{ $chapter->issue_number }}</p>
                    <p>Fecha de lanzamiento: {{ $chapter->release_date }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="#" class="btn btn-primary">Leer</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
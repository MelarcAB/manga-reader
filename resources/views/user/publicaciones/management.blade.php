@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Capítulos de la serie "{{ $serie->name }}"</h2>

    @if (count($chapters) > 0)
    <table class="table">
        <thead>
            <tr>
                <th>Número de capítulo</th>
                <th>Nombre</th>
                <th>Fecha de publicación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($chapters as $chapter)
            <tr>
                <td>{{ $chapter->issue_number }}</td>
                <td>{{ $chapter->name }}</td>
                <td>{{ $chapter->release_date }}</td>
                <td>
                    <a href="{{ route('chapter.pages', $chapter->id) }}" class="btn btn-primary">Ver</a>
                    <a href="" class="btn btn-warning">Editar</a>
                    <form action="" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de querer eliminar este capítulo?');">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>No hay capítulos para esta serie.</p>
    @endif
    <a href="{{route('publication.uploadchapter',$chapter->series_id)}}" class="btn btn-primary mt-2">Subir capítulo</a>
</div>
@endsection
@extends('layouts.app')

@section('content')

<div class="container palette-container">
    <h2>Publicaciones</h2>
    @if (count($series) > 0)
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Imagen</th>
                <th>Número de capítulos</th>
                <th>Fecha de inicio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($series as $serie)
            <tr>
                <td>{{ $serie->name }}</td>
                <td>
                    <img src="{{ asset('storage/series/'.$serie->id.'/'.$serie->img) }}" alt="Imagen de la serie {{ $serie->name }}" width="50">

                </td>

                <td>{{ count($serie->chapters) }}</td>
                <td>{{ $serie->start_date }}</td>
                <td>
                    <a href="{{route('user.edit-publicacion',['id'=> $serie->id])}}" class="btn btn-primary">Editar</a>
                    <a href="{{route('publication.manage',['id'=> $serie->id])}}" class="btn btn-primary">Gestionar</a>
                    <form method="POST" action="{{ route('series.destroy', $serie->id) }}" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirmDelete(this)" class="btn btn-danger" style="display: inline-block;">Eliminar</button>
                    </form>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>No tienes ninguna serie publicada.</p>
    @endif
    <a href="{{route('user.publicacion')}}" class="btn btn-primary mt-2">Crear nueva serie</a>
</div>
@endsection
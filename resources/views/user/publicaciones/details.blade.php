@extends('layouts.app')

@section('content')

<div class="container">
    <h2>Publicaciones</h2>
    @if (count($series) > 0)
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Número de tomos</th>
                <th>Fecha de inicio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($series as $serie)
            <tr>
                <td>{{ $serie->name }}</td>
                <td>{{ $serie->number_of_issues }}</td>
                <td>{{ $serie->start_date }}</td>
                <td>
                    <form method="POST" action="{{ route('series.destroy', $serie->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="confirmDelete()">Eliminar</button>
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
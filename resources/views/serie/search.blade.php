@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <h2>Resultados de la búsqueda: "{{ $q }}"</h2>
            @if (count($series) > 0)
            <h4>Series</h4>
            <div class="row">
                @foreach ($series as $serie)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{asset('storage/series/' . $serie->id . '/' . $serie->img) }}" class=" img-thumbnail" alt="Imagen de la serie">
                        <div class="card-body">
                            <h5 class="card-title">{{ $serie->name }}</h5>
                            <p class="card-text">{{ $serie->description }}</p>
                            <a href="{{ route('serie.show',['id'=>$serie->id]) }}" class="btn btn-primary">Ver más</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <p>No se han encontrado series con ese término de búsqueda.</p>
            @endif
        </div>
    </div>
</div>
@endsection
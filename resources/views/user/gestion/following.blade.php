@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <h2>Siguiendo</h2>
            @if (count($series) > 0)
            <div class="row rounded-lg">
                @foreach ($series as $serie)
                <div class="col-md-4 mb-4" style="border-radius: 25px;">
                    <div class="card border-0 rounded-lg" style="border-radius: 25px;">
                        <img src="{{asset('storage/series/' . $serie->id . '/' . $serie->img) }}" class="" alt="Imagen de la serie" style="object-fit: cover; height: 200px;">
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
            <p>No estás siguiendo ninguna serie.</p>
            @endif
        </div>
    </div>
</div>
@endsection
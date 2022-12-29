@extends('layouts.app')
@section('content')

<div class="container palette-container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1>Series</h1>
            <div class="row">
                @foreach ($series as $serie)

                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm card-no-border">
                        <div class="card-img-top-container">
                            <img src="{{ asset('storage/series/'.$serie->id.'/'.$serie->img) }}" class="card-img-top" alt="Imagen de la serie">
                            <div class="dark-overlay">
                                <h5 class="card-title text-center">{{ $serie->name }}</h5><br>

                                <p>Autor: {{ $serie->author->name }}</p>
                                <p>Autor: {{ $serie->author->name }}</p>

                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
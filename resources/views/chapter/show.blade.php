@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ $chapter->name }}</h2>
    <p>{{ $chapter->description }}</p>
    <p>Número de capítulo: {{ $chapter->issue_number }}</p>
    <p>Fecha de lanzamiento: {{ $chapter->release_date }}</p>
    <h3>Páginas</h3>
    @foreach ($chapter->pages() as $page)
    <img src="{{ asset('storage/series/'.$chapter->series_id.'/chapters/'.$chapter->id.'/'.$page['name']) }}" class="mx-auto d-block img-fluid" alt="{{ $page['name'] }}">
    @endforeach
</div>
@endsection
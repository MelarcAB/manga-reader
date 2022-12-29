@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Capítulo {{ $chapter->issue_number }} - {{ $chapter->name }}</h2>
    <p>Publicado: {{ $chapter->release_date }}</p>
    @if(count($chapter->pages())>0)
    @foreach ($chapter->pages() as $page)
    <img src="{{ asset('storage/series/'.$chapter->series_id.'/chapters/'.$chapter->id.'/'.$page['name']) }}" class="mx-auto d-block img-fluid" alt="{{ $page['name'] }}">
    @endforeach
    @else
    <p>Error al cargar páginas</p>

    @endif

</div>
@endsection
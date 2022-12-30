@extends('user.gestion.gestion-layout')

@section('account-content')

<!-- Formulario de edición de cuenta -->
<form action="{{route('user.update-profile-info')}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('POST')


    <div class="form-group">
        <label for="name">Nombre</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ Auth::user()->name }}">
    </div>
    <br>
    <div class="form-group">
        <label for="description">Descripción (visible en tu perfil)</label>
        <textarea name="description" id="description" class="form-control">{{ Auth::user()->description }}</textarea>
    </div>


    <br>

    <button type="submit" class="btn btn-primary">Actualizar cuenta</button>
</form>
@endsection
@extends('user.gestion.gestion-layout')

@section('account-content')

<!-- Formulario de edición de cuenta -->
<form action="{{route('user.update-account-info')}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('POST')


    <div class="form-group">
        <label for="username">Nombre de usuario</label>
        <input type="text" name="username" id="username" class="form-control" readonly value="{{ Auth::user()->nickname }}">
    </div>
    <br>
    <div class="form-group">
        <label for="email">Correo electrónico</label>
        <input type="email" name="email" id="email" class="form-control" value="{{ Auth::user()->email }}" required>
    </div>
    <br>
    <div class="form-group row align-items-center">
        <div class="col-2">
            <img src="{{ asset('storage/users/'. Auth::user()->image) }}" alt="Imagen de perfil" class="img-thumbnail" style="width: 100%">
        </div>
        <div class="col-5">
            <label for="image">Cambiar imagen de perfil</label>
            <input type="file" name="image" id="image" class="form-control-file">
        </div>
    </div>

    <br>

    <button type="submit" class="btn btn-primary">Actualizar cuenta</button>
</form>
@endsection
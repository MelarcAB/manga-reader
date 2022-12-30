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
    <div class="form-group">
        <label for="social_nets">Redes sociales</label>
        <div class="row">
            @foreach ($socialNets as $socialNet)
            <div class="col-md-3">
                <i class="{{ $socialNet->icon }}"></i> {{ $socialNet->name }}:
                <input type="text" name="social_nets[{{ $socialNet->id }}]" placeholder="URL" class="form-control" value="{{ $userSocialNets[$socialNet->id] ?? '' }}">
            </div>
            @endforeach
        </div>
    </div>

    <br>

    <button type="submit" class="btn btn-primary">Actualizar cuenta</button>
</form>
@endsection
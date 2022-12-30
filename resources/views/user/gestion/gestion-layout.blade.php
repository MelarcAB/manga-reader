@extends('layouts.app')

@section('content')

<div class="container mt-5">
    @if (session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif
    <div class="row">
        <div class="col-3">
            <!-- Menú de opciones de gestión de cuenta -->
            <ul class="list-group">
                <li class="list-group-item"><a href="{{route('user.manage-account')}}">Cuenta</a></li>
                <li class="list-group-item"><a href="">Notificaciones</a></li>
                <li class="list-group-item"><a href="{{route('user.manage-profile')}}">Perfil</a></li>
                <li class="list-group-item"><a href="">Privacidad</a></li>
                <!-- Otros elementos del menú -->
            </ul>
        </div>
        <div class="col-9">
            <!-- Contenido de la vista seleccionada -->
            @yield('account-content')
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-3">
            <!-- Menú de opciones de gestión de cuenta -->
            <ul class="list-group">
                <li class="list-group-item"><a href="">Cuenta</a></li>
                <li class="list-group-item"><a href="">Notificaciones</a></li>
                <li class="list-group-item"><a href="">Perfil</a></li>
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
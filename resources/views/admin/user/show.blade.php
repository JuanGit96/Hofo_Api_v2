@php
    $pageHeader = "DETALLES DE USUARIO"
@endphp

@extends("admin.layout")

@section("admin_content")

    <div class="container box box-default">
        <div class="background">
            <h1 class="title">Detalle del usuario #{{$user->id}}</h1>
        </div>
        <p><b>Nombre del usuario:</b> {{$user->name}}</p>
        <p><b>e-mail del Usuario</b> {{$user->email}}</p>
        <p><b>Apellido del Usuario:</b> {{$user->lastName}}</p>
        <p><b>Direccion del Usuario:</b> {{$user->address}}</p>
        <p><b>Telefono del Usuario:</b> {{$user->phone}}</p>
        <p><b>Tipo de chef:</b> {{($user->type_chef == 1)?"Profesional":"Aficionado"}}</p>
        <p><b>¿Tiene restaurante opunto de venta?:</b> {{($user->have_restaurant_or_foodPoint == 1)?"Si":"No"}}</p>
        <p><b>rol del Usuario:</b> <small @role_color($user->role_id)>{{$user->role->name}}</small></p>

        <p class="return_index">
            <a class="btn btn-info" href="{{url('/admin/users')}}">Regresar al listado</a>
        </p>
    </div>

@stop

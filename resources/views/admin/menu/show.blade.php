@php
    $pageHeader = "DETALLES DE USUARIO"
@endphp

@extends("admin.layout")

@section("admin_content")

    <div class="container box box-default">
        <div class="background">
            <h1 class="title">Detalle del usuario #{{$menu->id}}</h1>
        </div>
        <p><b>Nombre del menú:</b> {{$menu->nombre}}</p>
        <p><b>Descripcion del menu</b> {{$menu->descripcion}}</p>
        <p><b>Precio:</b> {{$menu->precio}}</p>
        <p><b>Precio de venta:</b> {{$menu->precio_venta}}</p>
        <p><b>Tipo de menu:</b> {{($menu->type_menu == 1)?"Diario":"Semanal"}}</p>
        <p><b>Chef asociado:</b> {{$menu->user->name}}</p>
        @if(isset($menu->foto))

            <div class="row">
                <a download="foto" title="foto" href="{{asset('storage/'.$menu->foto)}}"><i class="fa fa-download fa-3x"></i></a>
            </div>
        @endif

        <p class="return_index">
            <a class="btn btn-info" href="{{url('/admin/menus')}}">Regresar al listado</a>
        </p>
    </div>

@stop

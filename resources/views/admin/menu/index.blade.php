@php
    $pageHeader = "PANEL DE CONTROL - MENUS";
    $pathRoute = "menus.";
@endphp

@extends("admin.layout")

@section("admin_content")

    <p>
        <a href="{{ route($pathRoute.'create') }}" class="btn btn-primary">Nuevo Menú
            <i class="fa fa-plus-circle"></i>
        </a>
    </p>

    <div class="box box-default table-responsive">

        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif

        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Precio</th>
                <th scope="col">Precio venta</th>
                <th scope="col">Foto</th>
                <th scope="col">tipo de menú</th>
                <th scope="col">chef</th>
                <th scope="col">Acciones</th>
            </tr>
            </thead>
            <!--Mostrando usuarios-->
            @forelse($menus as $menu)
                <tr>
                    <th scope="row"> {{$menu->id}}</th>
                    <td> {{$menu->nombre}}</td>
                    <td> {{$menu->descripcion}}</td>
                    <td> {{$menu->precio}}</td>
                    <td> {{$menu->precio_venta}}</td>
                    <td><img width="50px" src="{{asset('storage/'.$menu->foto)}}" ></td>
                    <td> {{($menu->type_menu == 1)?"Diario":"Semanal"}}</td>
                    <td> {{$menu->user->name}}</td>
                    <td class="action">
                        <form method="POST" action="{{route($pathRoute.'destroy',$menu->id)}}">
                        {{ csrf_field() }}<!--Protección de ataques laravel(token)-->
                            {{ method_field('DELETE') }}
                            <a class="btn btn-link" href="{{route($pathRoute.'index')}}/{{$menu->id}}"><span class="fa fa-eye"></span></a>
                            <a class="btn btn-link" href="{{route($pathRoute.'edit', $menu->id)}}"><span class="fa fa-pencil"></span></a>
                            <button class="btn btn-link" type="submit" name="delete"><span class="fa fa-trash"></span></button>
                        </form>
                    </td>
                </tr>
            @empty
                <h3 class="alert alert-danger text-center">Noy Hay registros Aún</h3>
            @endforelse
        </table>
        {{--Paginación--}}
        <div class="center-block">
            {{$menus->links()}}
        </div>
    </div>


@stop

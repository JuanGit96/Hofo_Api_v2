@php
    $pageHeader = "PANEL DE CONTROL - USUARIOS";
    $pathRoute = "users.";
@endphp

@extends("admin.layout")

@section("admin_content")

    <p>
        <a href="{{ route($pathRoute.'create') }}" class="btn btn-primary">Nuevo Usuario
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
                <th scope="col">Rol</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Direccion</th>
                <th scope="col">Telefono</th>
                <th scope="col">Correo electronico</th>
                <th scope="col">Acciones</th>
            </tr>
            </thead>
            <!--Mostrando usuarios-->
            @forelse($users as $user)
                <tr>
                    <th scope="row"> {{$user->id}}</th>
                    <td> <small @role_color($user->role_id)>{{$user->role->name}}</small></td>
                    <td> {{$user->name}}</td>
                    <td> {{$user->lastName}}</td>
                    <td> {{$user->address}}</td>
                    <td> {{$user->phone}}</td>
                    <td>{{$user->email}}</td>
                    <td class="action">
                        <form method="POST" action="{{route($pathRoute.'destroy',$user->id)}}">
                        {{ csrf_field() }}<!--Protección de ataques laravel(token)-->
                            {{ method_field('DELETE') }}
                            <a class="btn btn-link" href="{{route($pathRoute.'index')}}/{{$user->id}}"><span class="fa fa-eye"></span></a>
                            <a class="btn btn-link" href="{{route($pathRoute.'edit', $user->id)}}"><span class="fa fa-pencil"></span></a>
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
            {{$users->links()}}
        </div>
    </div>


@stop

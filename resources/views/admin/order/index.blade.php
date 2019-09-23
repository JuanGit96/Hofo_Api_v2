@php
    $pageHeader = "PANEL DE CONTROL - ORDENES";
    $pathRoute = "orders.";
@endphp

@extends("admin.layout")

@section("admin_content")

    <p>
        <a href="{{ route($pathRoute.'create') }}" class="btn btn-primary">Nueva Orden
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
                <th scope="col">Fecha y hora</th>
                <th scope="col">Direccion</th>
                <th scope="col">Cantidad de platos</th>
                <th scope="col">Total a cobrar</th>
                <th scope="col">¿Orden agendada?</th>
                <th scope="col">Menú</th>
                <th scope="col">Chef</th>
                <th scope="col">Comensal</th>
                <th scope="col">Fecha creación</th>
                <th scope="col">Fecha actualización</th>
                <th scope="col">Acciones</th>
            </tr>
            </thead>
            <!--Mostrando usuarios-->
            @forelse($orders as $order)
                <tr>
                    <th scope="row"> {{$order->id}}</th>
                    <td> {{$order->hour}}</td>
                    <td> {{$order->address}}</td>
                    <td> {{$order->amount_people}}</td>
                    <td> {{$order->total_charge}}</td>
                    <td> {{($order->isSchedule == 1)?"Si":"No"}}</td>
                    @if(isset($order->menu->nombre))
                        <td> {{$order->menu->nombre}}</td>
                        <td> {{$order->menu->user->name}}</td>
                    @else
                        <td> -- </td>
                        @if(isset($order->chef->name))
                            <td> {{$order->chef->name}}</td>
                        @else
                            <td> -- </td>
                        @endif

                    @endif

                    <td> {{$order->diner->name}}</td>

                    <td> {{$order->created_at}}</td>
                    <td> {{$order->updated_at}}</td>
                    <td class="action">
                        <form method="POST" action="{{route($pathRoute.'destroy',$order->id)}}">
                        {{ csrf_field() }}<!--Protección de ataques laravel(token)-->
                            {{ method_field('DELETE') }}
                            <a class="btn btn-link" href="{{route($pathRoute.'index')}}/{{$order->id}}"><span class="fa fa-eye"></span></a>
                            <a class="btn btn-link" href="{{route($pathRoute.'edit', $order->id)}}"><span class="fa fa-pencil"></span></a>
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
            {{$orders->links()}}
        </div>
    </div>


@stop

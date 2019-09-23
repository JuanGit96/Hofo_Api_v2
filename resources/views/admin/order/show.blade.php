@php
    $pageHeader = "DETALLES DE USUARIO"
@endphp

@extends("admin.layout")

@section("admin_content")

    <div class="container box box-default">
        <div class="background">
            <h1 class="title">Detalle del orden #{{$order->id}}</h1>
        </div>
        <p><b>Hora:</b> {{$order->hour}}</p>
        <p><b>Direccion:</b> {{$order->address}}</p>
        <p><b>Cantidad de personas:</b> {{$order->amount_people}}</p>
        <p><b>Comentarios adicionales:</b> {{$order->additional_comments}}</p>
        <p><b>Total a cobrar:</b> {{$order->total_charge}}</p>
        <p><b>Tipo de orden:</b> {{($order->type_order == 1)?"Inmediata":"Programada"}}</p>
        <p><b>Tipo de pago:</b> {{($order->type_pay == 1)?"Contraentrega":"Transferencia"}}</p>
        <p><b>¿Está agendada?:</b> {{($order->isSchedule == 1)?"Si":"No"}}</p>
        <p><b>Modalidad:</b> {{($order->modality == 1)?"En casa del chef":"Chef en casa"}}</p>
        <p><b>Ocacion:</b> {{$order->chance}}</p>
        <p><b>Tipo de comida:</b> {{$order->food_type}}</p>

        @if(isset($order->menu->nombre))
            <p><b>Menú asociado:</b> {{$order->menu->nombre}}</p>
            <p><b>Chef:</b> {{$order->menu->user->name}}</p>
        @else
            <p><b>Menú asociado:</b> -- </p>
            @if(isset($order->chef->name))
                <p><b>Chef:</b> {{$order->chef->name}}</p>
            @else
                <p><b>Chef:</b> -- </p>
            @endif
        @endif


        <p><b>Comensal:</b> {{$order->diner->name}}</p>
        <p><b>Status:</b> {{($order->status == 0)?"Sin validar":($order->status == 1)?"Aceptada":"Rechazada"}}</p>
        <p><b>Fecha de creacion:</b> {{$order->created_at}}</p>
        <p><b>Fecha de actualizacion:</b> {{$order->updated_at}}</p>

        <p class="return_index">
            <a class="btn btn-info" href="{{url('/admin/orders')}}">Regresar al listado</a>
        </p>
    </div>

@stop

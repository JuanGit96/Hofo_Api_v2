@php
    $pageHeader = "EDITAR ORDEN"
@endphp

@extends("admin.layout")

@section("admin_content")


    @component('admin.order.partals.form')
        @slot('menus', $menus)
        @slot('chefs', $chefs)
        @slot('diners', $diners)
        @slot('order', $order)
        @slot('method', 'PUT')
        @slot('url', route('orders.update',$order->id))
        @slot('action', "EDITAR ORDEN")
        @slot('this_update', "true")
    @endcomponent


@stop

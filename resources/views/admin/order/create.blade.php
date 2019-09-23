@php
$pageHeader = "CREAR ORDEN"
@endphp

@extends("admin.layout")

@section("admin_content")

    @component('admin.order.partals.form')
        @slot('menus', $menus)
        @slot('chefs', $chefs)
        @slot('diners', $diners)
        @slot('url', route('orders.store'))
        @slot('action', "CREAR ORDEN")
    @endcomponent

@stop

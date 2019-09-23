@php
    $pageHeader = "EDITAR MENÚ"
@endphp

@extends("admin.layout")

@section("admin_content")


    @component('admin.menu.partals.form')
        @slot('users', $users)
        @slot('menu', $menu)
        @slot('method', 'PUT')
        @slot('url', route('menus.update',$menu->id))
        @slot('action', "EDITAR MENÚ")
        @slot('this_update', "true")
    @endcomponent


@stop

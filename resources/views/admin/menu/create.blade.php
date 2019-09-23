@php
$pageHeader = "CREAR MENÚ"
@endphp

@extends("admin.layout")

@section("admin_content")

    @component('admin.menu.partals.form')
        @slot('users', $users)
        @slot('url', route('menus.store'))
        @slot('action', "CREAR MENÚ")
    @endcomponent

@stop

@php
$pageHeader = "CREAR USUARIO"
@endphp

@extends("admin.layout")

@section("admin_content")

    @component('admin.user.partals.form')
        @slot('roles', $roles)
        @slot('url', route('users.store'))
        @slot('action', "CREAR USUARIO")
    @endcomponent

@stop
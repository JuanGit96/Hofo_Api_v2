@php
    $pageHeader = "EDITAR USUARIO"
@endphp

@extends("admin.layout")

@section("admin_content")


    @component('admin.user.partals.form')
        @slot('roles', $roles)
        @slot('user', $user)
        @slot('method', 'PUT')
        @slot('url', route('users.update',$user->id))
        @slot('action', "EDITAR USUARIO")
        @slot('this_update', "true")
    @endcomponent


@stop
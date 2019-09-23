@if($errors->any())<!--Si tenemos algun error-->
<div class="alert alert-danger">
    <h5>Porfavor corrige los errores</h5>
    <ul>
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif
<form method="post" action="{{$url}}">
{{ csrf_field() }}<!--Protección de ataques laravel(token)-->

    <input name="_method" type="hidden" value="{{(isset($method)?$method:"post")}}">

    @if(isset($this_update))
        <input type="hidden" value="true" name="this_update">
        <input type="hidden" value="{{(isset($menu->id)?$menu->id:"")}}" name="id">
    @endif

    <div class="form-group">
        <label for="nombre">Nombre</label>
        <input type="text" class="form-control"
               id="nombre" name="nombre" value="{{(isset($menu->nombre)?$menu->nombre:old('nombre'))}}"
               placeholder="">
    </div>

    <div class="form-group">
        <label for="descripcion">Descripción</label>
        <input type="text" class="form-control"
               id="descripcion" name="descripcion" value="{{(isset($menu->descripcion)?$menu->descripcion:old('descripcion'))}}"
               placeholder="">
    </div>

    <div class="form-group">
        <label for="precio">Precio</label>
        <input type="text" class="form-control"
               id="precio" name="precio" value="{{(isset($menu->precio)?$menu->precio:old('precio'))}}"
               placeholder="">
    </div>

    <div class="form-group">
        <label for="precio_venta">Precio Venta</label>
        <input type="text" class="form-control"
               id="precio_venta" name="precio_venta" value="{{(isset($menu->precio_venta)?$menu->precio_venta:old('precio_venta'))}}"
               placeholder="">
    </div>

    <div class="form-group">
        <label for="type_menu">Tipo de menú</label>
        <select class="form-control" id="type_menu" name="type_menu">
            <option value="" {{(isset($menu->type_menu))?"":"selected"}}>sin selección</option>

                <option {{(!isset($menu->type_menu))?"":($menu->type_menu == 1)?"selected":""}}
                        value="1">Diario</option>
                <option {{(!isset($menu->type_menu))?"":($menu->type_menu == 2)?"selected":""}}
                    value="2">Semanal</option>

        </select>
    </div>

    <div class="form-group">
        <label for="user_id">Chef</label>
        <select class="form-control" id="user_id" name="user_id">
            <option value="" {{(isset($menu->user_id))?"":"selected"}}>sin chef asignado</option>
            @foreach($users as $user)
                <option {{(!isset($menu->user_id))?"":($menu->user_id == $user->id)?"selected":""}}
                        value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">{{$action}}</button>
    <a class="btn btn-info" href="{{url('/admin/menus')}}">Regresar al listado</a>
</form>

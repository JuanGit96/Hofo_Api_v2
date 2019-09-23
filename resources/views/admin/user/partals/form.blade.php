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
        <input type="hidden" value="{{(isset($user->id)?$user->id:"")}}" name="id">
    @endif

    <div class="form-group">
        <label for="name">Nombre</label>
        <input type="text" class="form-control"
               id="name" name="name" value="{{(isset($user->name)?$user->name:old('name'))}}"
               placeholder="">
    </div>
    <div class="form-group">
        <label for="lastName">Apellido</label>
        <input type="text" class="form-control"
               id="lastName" name="lastName" value="{{(isset($user->lastName)?$user->lastName:old('lastName'))}}"
               placeholder="">
    </div>
    <div class="form-group">
        <label for="email">Correo electronico</label>
        <input type="email" class="form-control"
               id="email" name="email" value="{{(isset($user->email))?$user->email:old('email')}}"
               placeholder="">
    </div>
    <div class="form-group">
        <label for="phone">Telefono</label>
        <input type="number" class="form-control"
               id="phone" name="phone" value="{{(isset($user->phone)?$user->phone:old('phone'))}}"
               placeholder="">
    </div>

    <div class="form-group">
        <label for="address">Dirección</label>
        <input type="text" class="form-control"
               id="address" name="address" value="{{(isset($user->address)?$user->address:old('address'))}}"
               placeholder="">
    </div>

    <div class="form-group">
        <label for="role_id">Rol</label>
        <select class="form-control" id="role_id" name="role_id">
            <option value="" {{(isset($user->role_id))?"":"selected"}}>sin rol</option>
            @foreach($roles as $role)
                <option {{(!isset($user->role_id))?"":($user->role_id == $role->id)?"selected":""}}
                        value="{{$role->id}}">{{$role->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="type_chef">Tipo de chef</label>
        <select class="form-control" id="type_chef" name="type_chef">
            <option value="" {{(isset($user->type_chef))?"":"selected"}}>sin selección</option>

                <option {{(!isset($user->type_chef))?"":($user->type_chef == 1)?"selected":""}}
                        value="1">Profesional</option>
                <option {{(!isset($user->type_chef))?"":($user->type_chef == 2)?"selected":""}}
                    value="2">Aficionado</option>

        </select>
    </div>

    <div class="form-group">
        <label for="have_restaurant_or_foodPoint">¿Tiene restaurante o punto de venta?</label>
        <select class="form-control" id="have_restaurant_or_foodPoint" name="have_restaurant_or_foodPoint">
            <option value="" {{(isset($user->have_restaurant_or_foodPoint))?"":"selected"}}>sin selección</option>

                <option {{(!isset($user->have_restaurant_or_foodPoint))?"":($user->have_restaurant_or_foodPoint == 1)?"selected":""}}
                        value="1">Si</option>

                <option {{(!isset($user->have_restaurant_or_foodPoint))?"":($user->have_restaurant_or_foodPoint == 0)?"selected":""}}
                    value="0">No</option>

        </select>
    </div>

    <div class="form-group">
        <label for="password">Contraseña</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="">
    </div>

    <div class="form-group">
        <label for="password_confirmation">Confirmacion de Contraseña</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="">
    </div>

    <button type="submit" class="btn btn-primary">{{$action}}</button>
    <a class="btn btn-info" href="{{url('/admin/users')}}">Regresar al listado</a>
</form>

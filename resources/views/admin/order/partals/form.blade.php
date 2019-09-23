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
        <input type="hidden" value="{{(isset($order->id)?$order->id:"")}}" name="id">
    @endif

    <div class="form-group">
        <label for="hour">Hora</label>
        <input type="text" class="form-control"
               id="hour" name="hour" value="{{(isset($order->hour)?$order->hour:old('hour'))}}"
               placeholder="">
    </div>


    <div class="form-group">
        <label for="address">Dirección</label>
        <input type="text" class="form-control"
               id="address" name="address" value="{{(isset($order->address)?$order->address:old('address'))}}"
               placeholder="">
    </div>

    <div class="form-group">
        <label for="hour">Fecha y Hora</label>
        <input type="text" class="form-control"
               id="hour" name="hour" value="{{(isset($order->hour)?$order->hour:old('hour'))}}"
               placeholder="">
    </div>

    <div class="form-group">
        <label for="amount_people">Cantidad de platos</label>
        <input type="number" class="form-control"
               id="amount_people" name="amount_people" value="{{(isset($order->amount_people)?$order->amount_people:old('amount_people'))}}"
               placeholder="">
    </div>

    <div class="form-group">
        <label for="additional_comments">Comentarios adicionales</label>
        <input type="text" class="form-control"
               id="additional_comments" name="additional_comments" value="{{(isset($order->additional_comments)?$order->additional_comments:old('additional_comments'))}}"
               placeholder="">
    </div>

    <div class="form-group">
        <label for="total_charge">Total a pagar</label>
        <input type="number" class="form-control"
               id="total_charge" name="total_charge" value="{{(isset($order->total_charge)?$order->total_charge:old('total_charge'))}}"
               placeholder="">
    </div>

    <div class="form-group">
        <label for="type_order">Tipo de orden</label>
        <select class="form-control" id="type_order" name="type_order">
            <option value="" {{(isset($order->type_order))?"":"selected"}}>sin selección</option>

                <option {{(!isset($order->type_order))?"":($order->type_order == 1)?"selected":""}}
                        value="1">Inmediata</option>
                <option {{(!isset($order->type_order))?"":($order->type_order == 2)?"selected":""}}
                    value="2">Programada</option>

        </select>
    </div>

    <div class="form-group">
        <label for="type_pay">Tipo de pago</label>
        <select class="form-control" id="type_pay" name="type_pay">
            <option value="" {{(isset($order->type_pay))?"":"selected"}}>sin selección</option>

                <option {{(!isset($order->type_pay))?"":($order->type_pay == 1)?"selected":""}}
                        value="1">Contraentrega</option>
                <option {{(!isset($order->type_pay))?"":($order->type_pay == 2)?"selected":""}}
                    value="2">Transferencia</option>

        </select>
    </div>

    <div class="form-group">
        <label for="isSchedule">¿Es un servicio agendado?</label>
        <select class="form-control" id="isSchedule" name="isSchedule">
            <option value="" {{(isset($order->isSchedule))?"":"selected"}}>sin selección</option>

                <option {{(!isset($order->isSchedule))?"":($order->isSchedule == 1)?"selected":""}}
                        value="1">Si</option>
                <option {{(!isset($order->isSchedule))?"":($order->isSchedule == 0)?"selected":""}}
                    value="0">No</option>

        </select>
    </div>

    <div class="form-group">
        <label for="modality">Modalidad</label>
        <select class="form-control" id="modality" name="modality">
            <option value="" {{(isset($order->modality))?"":"selected"}}>sin selección</option>

                <option {{(!isset($order->modality))?"":($order->modality == 1)?"selected":""}}
                        value="1">En casa del chef</option>
                <option {{(!isset($order->modality))?"":($order->modality == 2)?"selected":""}}
                    value="2">Chef en casa</option>

        </select>
    </div>

    <div class="form-group">
        <label for="chance">Ocación</label>
        <input type="text" class="form-control"
               id="chance" name="chance" value="{{(isset($order->chance)?$order->chance:old('chance'))}}"
               placeholder="">
    </div>

    <div class="form-group">
        <label for="food_type">Tipo de comida</label>
        <input type="text" class="form-control"
               id="food_type" name="food_type" value="{{(isset($order->food_type)?$order->food_type:old('food_type'))}}"
               placeholder="">
    </div>


    <div class="form-group">
        <label for="menu_id">Menu asociado</label>
        <select class="form-control" id="menu_id" name="menu_id">
            <option value="" {{(isset($order->menu_id))?"":"selected"}}>sin menú asignado</option>
            @foreach($menus as $menu)
                <option {{(!isset($order->menu_id))?"":($order->menu_id == $menu->id)?"selected":""}}
                        value="{{$menu->id}}">{{$menu->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="chef_id">Chef</label>
        <select class="form-control" id="chef_id" name="chef_id">
            <option value="" {{(isset($order->chef_id))?"":"selected"}}>sin chef asignado</option>
            @foreach($chefs as $chef)
                <option {{(!isset($order->chef_id))?"":($order->chef_id == $chef->id)?"selected":""}}
                        value="{{$chef->id}}">{{$chef->name}}</option>
            @endforeach
        </select>
    </div>


    <div class="form-group">
        <label for="diner_id">Comensal</label>
        <select class="form-control" id="diner_id" name="diner_id">
            <option value="" {{(isset($order->diner_id))?"":"selected"}}>sin comensal asignado</option>
            @foreach($diners as $diner)
                <option {{(!isset($order->diner_id))?"":($order->diner_id == $diner->id)?"selected":""}}
                        value="{{$diner->id}}">{{$diner->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="status">Status</label>
        <select class="form-control" id="status" name="status">
            <option value="" {{(isset($order->status))?"":"selected"}}>sin validar</option>

            <option {{(!isset($order->status))?"":($order->status == 1)?"selected":""}}
                value="1">Aprobada</option>
            <option {{(!isset($order->status))?"":($order->status == 2)?"selected":""}}
                value="2">Rechazada</option>

        </select>
    </div>




    <button type="submit" class="btn btn-primary">{{$action}}</button>
    <a class="btn btn-info" href="{{url('/admin/menus')}}">Regresar al listado</a>
</form>

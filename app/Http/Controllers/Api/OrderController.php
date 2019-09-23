<?php

namespace App\Http\Controllers\Api;

use App\Order;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function showByChef($chef_id)
    {
        $user = User::findOrFail($chef_id);

        $orders = [];

        #ordenes por menus
        $menus = $user->menus;

        foreach($menus as $key => $menu)
        {
            $orders = $menu->orders;

            foreach ($orders as $order)
            {
                $order->fotoMenu = $menu->foto;
            }

            $orders[$menu->nombre] = $orders;
        }

        #ordenes agendadas
        $schedules = $user->schedulesByChef;

        foreach($schedules as $schedule)
        {
            $orders[$schedule->chance." / ".$schedule->food_type] = [$schedule];
        }

        return response()->json(["data" =>$orders, "code" => 200], 200);
    }

    public function showByDiner($diner_id)
    {
        $orders = Order::where("diner_id","=",$diner_id)->get();

        foreach ($orders as $order)
        {
            if($order->menu != null)
            {
                $order->nameMenu = $order->menu->nombre;
                $order->fotoMenu = $order->menu->foto;
            }
            else #si no hay un menu asociado a la orden
                $order->nameMenu = $order->chance." / ".$order->food_type;
        }

        return response()->json(["data" =>$orders, "code" => 200], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$request->has('isSchedule'))
        {
            $rules = [
                "hour" => 'required',
                "address" => 'required',
                "menu_id" => 'required',
                "amount_people" => 'nullable',
                "additional_comments" => 'nullable',
                "total_charge" => 'required',
                "type_order" => 'required',
                "type_pay" => 'required',
                "diner_id" => 'required',
                'domiciliary' => 'required',
            ];
        }
        else
        {
            $rules = [
                "hour" => 'required',
                "modality" => 'required',
                "chance" => 'required',
                "food_type" => 'required',
                "isSchedule" => 'required',
                "diner_id" => 'required',
                'domiciliary' => 'required',
            ];
        }

        $messages = [
            "hour.required" => 'la hora de entrega es obligatoria',
            "address.required" => 'la direccion de entrega es obligatoria',
            "menu_id.required" => 'error al capturar identificador de menu',
            "amount_people.required" => "no enviaste cantidad de platos",
            "total_charge.required" => "no llegó el total a cobrar",
            "type_order.required" => "no especificaste el tipo de la orden",
            "type_pay.required" => "no especificaste el tipo de pago",
            "diner_id.required" => "no llegó el identificador de comensal",
            "modality.required" => "no llegó el identificador de modalidad",
            "type_food.required" => "no llegó el tipo de comida",
            "domiciliary.required" => "no llegó el valor del domicilio",
        ];

        $v = Validator::make($request->all(), $rules, $messages);

        if ($v->fails())
        {
            return response()->json(["error" => $v->errors()->first(), "code" => 400], 200);
        }

        $data = $request->all();



        $order = Order::create($data);

        return response()->json(["data" => $order, "code" => 201], 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $menu = $order->menu;

        $order->menu_name = $menu->nombre;

        return response()->json(["data" =>$order, "code" => 200], 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $order->status = $request->status;

        if(!$order->isDirty())
        {
            return response()->json(["error" => 'se debe especificar al menos un valor diferente para actualizar', "code" => 422],422);
        }

        $order->save();

        return response()->json(["data" => $order, "code"=>201],201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

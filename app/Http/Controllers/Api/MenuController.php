<?php

namespace App\Http\Controllers\Api;

use App\Http\Traits\FileTrait;
use App\Http\Traits\RelationTrait;
use App\Menu;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class MenuController extends Controller
{
    use FileTrait;

    use RelationTrait;

    private $profit;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->profit = 0.1;
    }

    public function index()
    {
        $menus = Menu::active()->get();

        return response()->json(["data" =>$menus, "code" => 200], 200);
    }

    public function menusByChef($id)
    {
        $user = User::findOrFail($id);

        $menus = Menu::active()->where("user_id","=",$user->id)->get();

        return response()->json(["data" =>$menus, "code" => 200], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            "nombre" => "required",
            "descripcion" => "required",
            "precio" => "required",
            //"foto" => "required",
            "type_menu" => "required",
            "user_id" => "required"
        ];

        $messages = [
            "nombre.required" => "El campo nombre es obligatorio",
            "descripcion.required" => "El campo descripcion es obligatorio",
            "precio.required" => "el campo precio es obligatorio",
            "foto.required" => "el campo foto es obligatorio",
            "type_menu" => "El campo tipo de menú es obligatorio",
            "user_id.required" => "Error al capturar el id de usurio en sesión, contacte a los administradores"
        ];

        $v = Validator::make($request->all(), $rules, $messages);

        if ($v->fails())
        {
            return response()->json(["error" => $v->errors()->first(), "code" => 400], 200);
        }

        $data = $request->all();

        if ($request->has('foto'))
        {
            $name = $this->saveFileBas64($data["nombre"],$data["foto"]);

            if ($name != false)
                $data["foto"] = $name;
            else
                return response()->json(["error" =>"error a subir adjunto del campo 'Foto'", "code" => 400], 200);
        }

        $data["precio_venta"] = $data["precio"]+ ($data["precio"]*$this->profit);

        $menu = Menu::create($data);

        #$savedMenuModalities = $this->saveModalitiesByMenu($request->modalidades,$menu->id);

        #if (!$savedMenuModalities)
         #   return response()->json(["error" =>"error al guardar modalidades asociadas al menu", "code" => 400], 200);

        return response()->json(["data" => $menu, "code" => 201], 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $menu = Menu::findOrFail($id);

        return response()->json(["data" =>$menu, "code" => 200], 200);
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
        $menu = Menu::findOrFail($id);

        $rules = [
            "nombre" => "required",
            "descripcion" => "required",
            "precio" => "required",
            //"foto" => "required",
            "type_menu" => "required",
            "user_id" => "required"
        ];

        $messages = [
            "nombre.required" => "El campo nombre es obligatorio",
            "descripcion.required" => "El campo descripcion es obligatorio",
            "precio.required" => "el campo precio es obligatorio",
            "foto.required" => "el campo foto es obligatorio",
            "type_menu" => "El campo tipo de menú es obligatorio",
            "user_id.required" => "Error al capturar el id de usurio en sesión, contacte a los administradores"
        ];

        $v = Validator::make($request->all(), $rules, $messages);

        if ($v->fails())
        {
            return response()->json(["error" => $v->errors()->first(), "code" => 400], 200);
        }

        $data = $request->all();

        if ($request->has('foto'))
        {
            if ($data["foto"] != "" && $data["foto"] != null)
            {
                $name = $this->saveFileBas64($data["nombre"],$data["foto"]);

                if ($name != false)
                    $data["foto"] = $name;
                else
                    return response()->json(["error" =>"error a subir adjunto del campo 'Foto'", "code" => 400], 200);
            }
            else
            {
                $data["foto"] = $menu->foto;
            }

        }
        else
        {
            $data["foto"] = $menu->foto;
        }

        $data["precio_venta"] = $data["precio"]+ ($data["precio"]*$this->profit);

        $menu->update($data);

        #$savedMenuModalities = $this->saveModalitiesByMenu($request->modalidades,$menu->id);

        #if (!$savedMenuModalities)
         #   return response()->json(["error" =>"error al guardar modalidades asociadas al menu", "code" => 400], 200);

        return response()->json(["data" => $menu, "code" => 201], 201);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);

        $orders = $menu->orders;

        foreach($orders as $order)
        {
            $order->delete();
        }

        $menu->delete();

        return response()->json(["code" => 201],204);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Traits\auxiliarCrud;
use App\Menu;
use App\User;
use App\Order;

class OrderController extends Controller
{
    use auxiliarCrud;

    private $pathViews;

    private $pathRoute;

    public function __construct()
    {
        $this->pathViews = "admin.order.";
        $this->pathRoute = "orders.";
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::paginate(9);

        return view($this->pathViews."index",compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $chefs = User::chefs();

        $diners = User::diners();

        $menus = Menu::active()->get();

        return view($this->pathViews."create",compact('chefs','diners','menus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        $data = $request->all();

        Order::create($data);

        return redirect()->route($this->pathRoute."index")->with("Success","Orden creada exitosamente");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view($this->pathViews."show",compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $chefs = User::chefs();

        $diners = User::diners();

        $menus = Menu::active()->get();

        return view($this->pathViews."edit",compact('order','chefs','diners','menus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OrderRequest $request, Order $order)
    {
        $data = $this->deleteCampNull($request);

        $order->update($data);

        return redirect()->route($this->pathRoute."show",$order->id)->with("success","Orden editada correctamente");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route($this->pathRoute."index")->with("success","Orden eliminada correctamente");
    }
}

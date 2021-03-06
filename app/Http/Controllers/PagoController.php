<?php

namespace App\Http\Controllers;

use App\Pago;
use App\Pedido;
use App\FormaPago;
use App\Proveedor;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Pago::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pago = new Pago();

        $pedido = Pedido::findOrFail($request->pedido_id);
        $formaPago = FormaPago::findOrFail($request->forma_pago_id);
        $proveedor = Proveedor::findOrFail($request->proveedor_id);

        $pago->monto = $request->monto;
        $pago->nro_confirmacion = $request->nro_confirmacion;

        $pago->pedido()->associate($pedido);
        $pago->formaPago()->associate($formaPago);
        $pago->proveedor()->associate($proveedor);
        $pago->save();

        return response()->json($pago);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Pago::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pago $pago)
    {
        $pago->monto = $request->monto;
        $pago->nro_confirmacion = $request->nro_confirmacion;

        $pago->pedido_id = $request->pedido_id;
        $pago->forma_pago_id = $request->forma_pago_id;
        $pago->proveedor_id = $request->proveedor_id;

        $pago->save();

        return response()->json($pago);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pago $pago)
    {
        return response()->json($pago->delete());
    }
}

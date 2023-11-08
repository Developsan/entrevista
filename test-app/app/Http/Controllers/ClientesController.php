<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes.clientes')->with([
            "clientes" => $clientes
        ]);


    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'fecha_nacimiento' => 'required',
            'telefono' => 'required',
            'fecha_compra' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'mensaje' => 'Surgio un error con la peticion',
                'error' => $validator->errors()
            ], 201);
        }else{

            Cliente::create([
                "nombre" => $request->nombre,
                "fecha_nacimiento" => Carbon::parse($request->fecha_nacimiento)->format('Y-m-d'),
                "telefono" => $request->telefono,
                "fecha_compra" => $request->fecha_compra
            ]);

            return response()->json([
                'Mensaje' => 'cliente creado exitosamente'
            ], 200);

        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($id->exists()){
            $cliente = Cliente::find($id);
            return response()->json([
                "mensaje" => "Cliente encontrado exitosamente",
                "cliente" => $cliente
            ], 200);
        }else{
            return response()->json([
                'error' => 'Ocurrio un error'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($id->exists()){
            $valdiator = Validator::make($request->all(),[
            'name' => 'required',
            'fecha_nacimiento' =>'required',
            'telefono' => 'required',
            'fecha_compra' => 'required'
            ]);

            $cliente = Cliente::find($id);
            $cliente->name = $request->name;
            $cliente->fecha_nacimiento = $request->fecha_nacimiento;
            $cliente->telefono = $request->telefono;
            $cliente->fecha_compra = $request->fecha_compra;

            $cliente->save();
            return response()->json([
                "mensaje" => "Cliente actualizado exitosamente",
            ], 200);
        }else{
            return response()->json([
                'error' => 'Ocurrio un error al buscar el cliente'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($id->exists()){
            $clienteEncontrado =  Cliente::find($id);
            $clienteEncontrado->destroy();
        }
        return response()->json([
            "mensaje" => "Cliente borrado exitosamente",
        ], 200);
    }
}

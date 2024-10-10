<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{

    public function __construct()
    {
        $this->middleware('can: Crear cliente')->only('create');
        $this->middleware('can: Eliminar cliente')->only('destroy');
    }


    public function index()
    {

        $clientes = Cliente::all();
        return view('sistema.cliente',['clientes' => $clientes]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'dni' => 'required|unique:clientes,dni|min:10',
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'email' => 'required|email|unique:clientes,email',
            'telefono' => 'required|numeric|min:15',
        ]);

        $cliente = new Cliente();

        $cliente->dni = $request->input('dni');
        $cliente->nombre = $request->input('nombre');
        $cliente->apellido = $request->input('apellido');
        $cliente->email = $request->input('email');
        $cliente->telefono = $request->input('telefono');
        $cliente->direccion = $request->input('direccion');
        $cliente->estado = $request->input('estado');

        $cliente->save();

        return redirect()->route('cliente.index')->with('exito', 'Ingreso con');
    }


    public function destroy(string $id)
    {
        $cliente = Cliente::find($id);
        $cliente->delete();

        return back();
    }
}

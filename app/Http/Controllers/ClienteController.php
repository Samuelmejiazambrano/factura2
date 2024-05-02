<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    public function index()
    {

        $datos2 = Cliente::paginate(5);

        return view('cliente.cliente', compact('datos2'));
    }

    public function create(Request $request)
    {

        $cliente = new Cliente;
        $cliente->nombre = $request->nombre;
        $cliente->apellido = $request->apellido;
        $cliente->edad = $request->edad;
        $cliente->correo = $request->correo;
        $cliente->direccion = $request->direccion;
        $cliente->telefono = $request->telefono;
        $cliente->ciudad = $request->ciudad;
        $cliente->save();
        if ($cliente) {
            return back()->with("message", "Usuario registrado correctamente");
        } else {
            return back()->with("error", "Error al registrar usuario");
        }
    }


    public function delete($idCliente)
    {
        $cliente = Cliente::find($idCliente);
        if ($cliente) {
            $cliente->delete();
            return back()->with("message", "Usuario eliminado correctamente");
        } else {
            return back()->with("error", "No se encontró el cliente con el ID proporcionado");
        }
    }

    public function update(Request $request)
    {
        $cliente = Cliente::find($request->id);

        if ($cliente) {
            $cliente->nombre = $request->nombre;
            $cliente->apellido = $request->apellido;
            $cliente->correo = $request->correo;
            $cliente->direccion = $request->direccion;
            $cliente->telefono = $request->telefono;
            $cliente->ciudad = $request->ciudad;
            $cliente->edad = $request->edad;
            $cliente->save();

            return back()->with("message", "Usuario actualizado correctamente");
        } else {
            return back()->with("error", "Error al actualizar usuario");
        }
    }


    public function indexCliente(Request $request)
    {
        $texto = trim($request->get('texto', ''));

        $clientes = Cliente::query();

        if (!empty($texto)) {
            $clientes = $clientes->where('nombre', 'like', "%$texto%");
        }

        $clientes = $clientes->orderBy('nombre', 'asc')->paginate(10);
        if ($request->ajax()) {
            return response()->json([
                'clientes' => $clientes
            ]);
        }


        return view('factura.factura', compact('clientes', 'texto'));
    }



}

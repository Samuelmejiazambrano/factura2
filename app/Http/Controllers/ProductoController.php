<?php

namespace App\Http\Controllers;

use App\Models\producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    public function index()
    {

        $datos = producto::paginate(5);

        return view('productos.productos', compact('datos'));
    }

   

    public function create(Request $request)
    {
        $producto = new producto();

        $producto->nombre = $request->nombre;
        $producto->cantidadDisponible = $request->cantidadDisponible;
        $producto->valorUnico = $request->valorUnico;
        $producto->save();
        if ($producto) {
            return back()->with("message", "Usuario registrado correctamente");
        } else {
            return back()->with("error", "Error al registrar usuario");
        }
    }
    public function delete(producto  $id_producto){
        $id_producto->delete();

        if ($id_producto==true) {
         return back()->with("message", "Usuario registrado correctamente");
        } else {
         return back()->with("error", "Error al registrar usuario");
        };

     }

   
    public function update(Request $request){
    $producto = producto::find($request->id);

    if ($producto) {
        $producto->nombre = $request->nombre;
        $producto->cantidadDisponible = $request->cantidadDisponible;
        $producto->valorUnico =$request->valorUnico;
        $producto->estado =  $request->estado;
        $producto->save();

        return back()->with("message", "Usuario actualizado correctamente");
    } else {
        return back()->with("error", "Error al actualizar usuario");
    }
}
}


<?php

namespace App\Http\Controllers;

use App\Models\factura;
use App\Models\producto;
use App\Models\detalle;
use App\Models\Cliente;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;



// use Illuminate\Support\Facades\DB;


class FacturaController extends Controller
{
    public function index(Request $request)
    {
        $texto2 = trim($request->get('texto2', ''));

        $productos = producto::query();


        if (!empty($texto2)) {
            $productos = $productos->where('nombre', 'like', "%$texto2%");
        }

        $productos = $productos->orderBy('nombre')->paginate(10);

        if ($request->ajax()) {
            return response()->json([
                'productos' => $productos,
            ]);
        }

        return view('factura.factura', compact('productos', 'texto2'));
    }


    // public function create(Request $request){

    //     date_default_timezone_set('America/Bogota');

    //     $registro = [];


    //     foreach ($request->fkcliente as $key => $cliente) {
    //         $registro[] = [
    //             'idCliente' => $cliente,
    //             'fechaCreacion' => date("Y-m-d H:i:s")
    //         ];
    //     }


    //     $sql = DB::table('factura')->insert($registro);

    //     if ($sql) {

    //         $ultimoId = DB::getPdo()->lastInsertId();


    //         // $productos = $request->fkproducto;
    //         // $cantidad = $request->cantidad;
    //         // $valor = $request->valor;
    //         // $total = $request->total;

    //         // $registros = [];


    //         $productos = $request->input('fkproducto');
    //         $cantidades = $request->input('cantidad');
    //         $valores = $request->input('valor');
    //         // $total = $request->input('total');

    //         $registros = [];

    //         foreach ($productos as $key => $producto) {
    //             $registros[] = [
    //                 'fkProducto' => $producto,
    //                 'fkFactura' => $ultimoId,
    //                 'cantidad' => $cantidades[$key], 
    //                 'subTotal' => $cantidades[$key] * $valores[$key], // Calcula el total multiplicando la cantidad por el valor
    //                 'valor' => $valores[$key] ,
    //                 // 'total' => $total[$key]
    //             ];
    //         }


    //         $detalleInsertado = DB::table('detalle')->insert($registros);

    //         if ($detalleInsertado) {
    //             return back()->with("message", "Factura y detalles registrados correctamente");
    //         } else {
    //             return back()->with("error", "Error al registrar detalles de factura");
    //         }
    //     } else {
    //         return back()->with("error", "Error al guardar factura");
    //     }
    // }

    public function create(Request $request)
    {

        $factura = new factura();
        $factura->fkCliente = $request->fkcliente;
        $factura->total = $request->total;
        $factura->save();



        if ($factura) {

            $ultimoId = $factura->id;


            $productos = $request->input('fkproducto');

            $cantidades = $request->input('cantidad');
            $valores = $request->input('valor');
            $nombre = $request->input('nombre');

            $total = 0;


            foreach ($productos as $key => $producto) {
                $subtotal = $cantidades[$key] * $valores[$key];
                $total += $subtotal;

                $detalle = new detalle();
                $detalle->fkProducto = $producto;
                $detalle->fkFactura = $ultimoId;
                $detalle->cantidad = $cantidades[$key];
                $detalle->subTotal = $subtotal;
                $detalle->valor = $valores[$key];
                $detalle->nombre = $nombre[$key];
                $detalle->total = $total;

                $detalle->save();

            }
            return back()->with("message", "Factura y detalles registrados correctamente.");
        } else {
            return back()->with("error", "Error al registrar la factura.");
        }
    }

    // public function buscarProductos(Request $request)
    // {
    //     $facturas = factura::with('cliente');

    //     if ($request->has('search')) {
    //         $texto = $request->search;
    //         $texto2 = $request->search2;
    //         $facturas->whereHas('cliente', function ($query) use ($texto) {
    //             $query->where('nombre', 'like', "%$texto%");
    //         })->orWhereHas('cliente', function ($query) use ($texto) {
    //             $query->where('ciudad', 'like', "%$texto%");
    //         });
    //     }

    //     if ($request->ajax()) {
    //         return DataTables::of($facturas)
    //         ->make(true);
    //     }

    //     return view('detallesFactura.detalle', compact('facturas'));
    // }


    public function buscarProductos(Request $request)
    {
        $facturas = factura::with('cliente');

        if ($request->has('search')) {
            $texto = $request->search;
            $facturas->whereHas('cliente', function ($query) use ($texto) {
                $query->where('nombre', 'like', "%$texto%");
            });
        }

        if ($request->has('search2')) {
            $texto2 = $request->search2;
            $facturas->whereHas('cliente', function ($query) use ($texto2) {
                $query->where('ciudad', 'like', "%$texto2%");
            });
        }

        if ($request->ajax()) {
            return DataTables::of($facturas)
                ->make(true);
        }
        
        return view('detallesFactura.detalle', compact('facturas'));
    }

    public function indexDetalle()
    {
        $facturas = factura::with('cliente')->get();
        $detallesFactura = detalle::all();


        return view('detallesFactura.detalle', compact('facturas', 'detallesFactura'));
    }

    public function mostrarDetalle($id)
    {
    
        $factura = factura::with('cliente')->where('id', $id)->get();
        $detalles = detalle::where('fkFactura', $id)->get();

        return view('mostrarDetalle.mostrarDetalle', compact('factura', 'detalles'));
    }
    
    public function pdf($id)
    {
        $factura = factura::with('cliente')->where('id', $id)->get();
        $detalles = detalle::where('fkFactura', $id)->get();
        
        $pdf = PDF::loadView('pdf.pdf', compact('factura', 'detalles'));
        return $pdf->download('Factura.pdf');
    }
    

}










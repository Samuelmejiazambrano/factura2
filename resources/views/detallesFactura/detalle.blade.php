@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1> </h1>
@stop

@section('content')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="{{ asset('js/detalle.js') }}"></script>


    {{-- <h1>detalle</h1> --}}


    <div class="padre vh-auto bg-relaxed-green" style="height:100vh;">



        <div class="container mt-5">

            <h1 class="text-center mb-4">Detalles de Factura</h1>
            <div class="inputs">
                <button type="button" class="btn bg-success text-white " style="margin-bottom: 50px"> <a class="nav-link"
                        href="/factura">Compra tu producto</a></button>


            </div>
            <table class="table table-striped table-bordered table-hover text-center" id="table_id">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>
                            <input id="nombreId" type="text" class="form-control" placeholder="Buscar por nombre">
                        </th>
                        <th>
                            <input id="ciudadId" type="text" class="form-control" placeholder="Buscar por ciudad">
                        </th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    <tr>
                        <th scope="col">#ID Factura</th>
                        <th scope="col">#ID cliente</th>
                        <th scope="col">Nombre Cliente</th>
                        <th scope="col">Ciudad</th>
                        <th scope="col">Total</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Mostrar Detalle</th>
                    </tr>

                </thead>
                <tbody>
                    @foreach ($facturas as $item)
                        <tr>

                            <td>
                                {{-- <button type="button" class="btn btn-primary show-detail" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal{{ $item->id }}" data-id="{{ $item->id }}">
                                    <i class="fas fa-pen-to-square"></i>
                                </button> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>


            @foreach ($facturas as $factura)
                <div class="modal fade" id="exampleModal{{ $factura->id }}" tabindex="-1"
                    aria-labelledby="exampleModalLabel{{ $factura->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel{{ $factura->id }}">Detalles de la Factura
                                    #{{ $factura->id }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-striped table-bordered table-hover text-center">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID Factura</th>
                                            <th scope="col">ID Producto</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Valor</th>
                                            <th scope="col">Cantidad</th>
                                            <th scope="col">subTotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($detallesFactura->where('fkFactura', $factura->id) as $detalle)
                                            <tr>
                                                <td>{{ $detalle->fkFactura }}</td>
                                                <td>{{ $detalle->fkProducto }}</td>
                                                <td>{{ $detalle->nombre }}</td>
                                                <td>{{ $detalle->valor }}</td>
                                                <td>{{ $detalle->cantidad }}</td>
                                                <td>{{ $detalle->subTotal }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>







@stop

@section('css')
    <style>
 .navbar-nav .nav-link {
            color: white !important;
        }

        .navbar-brand {
            color: white !important;
        }

        .navbar {
            background-color: #34495e;
            color: white !important;
        }
    </style>
@stop

@section('js')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
    
            let url = "{{ route('factura.buscarProductos') }}";
            cargarDatosTabla(url);
        });
    </script>
@stop


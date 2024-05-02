@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')


    <script src="{{ asset('js/detalles.js') }}"></script>
    {{-- <div class="padre vh-auto bg-relaxed-green" style="height:120vh;">
  
    <div class="container">
        <div class="cont">
            <div class="head">
                <h1>Detalles De Mi Factura</h1>
                <a href="/detalle" id="delete" <i class="fa-solid fa-delete-left fa-2x"></i>
                </a>



            </div>
            @foreach ($factura as $detalles)
                <a href="{{ route('cliente.pdf', ['id' => $detalles->id]) }}" class="btn btn-primary">
                    <i class="far fa-file-pdf"></i> Descargar PDF
                </a>
                <div>
                    <p><b>Cliente:</b>{{ $detalles->cliente->nombre }}</p>
                    <p><b>#Factura:</b>{{ $detalles->id }}</p>
                    <p><b>#Cliente:</b>{{ $detalles->fkCliente }}</p>
                    <p><b>ciudad:</b>{{ $detalles->cliente->ciudad }}</p>
                    <p><b>fecha:</b>{{ $detalles->created_at }}</p>

                </div>
                
                
            @endforeach




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
                    @foreach ($detallesFactura as $detalle)
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
            <div class="col-md-11 text-end" id="total2" style="width: 100%">

                <h3>Total:{{ $detalle->total }}</h3>

            </div>
        </div>
    </div>

</div> --}}


    <div class="container" style="height: auto";>
        <div class="cont2">
            <div class="empresa">
                <h1>Detalles de la Factura</h1>
                <p><b>Empresa:</b> Deposito el Nogal</p>
                <p><b>NIT:</b> 900178252-9</p>
                <p><b>Telefono:</b> 7242000 </p>
                <p><b>Ciudad:</b> San Gil</p>
                <p><b>Email:</b> contabilidad@depositoelnogal.com </p>
                <p><b>Vendedor:</b> Jaime Suarez </p>
            </div>

            <hr style="border: 1px solid black">

            @foreach ($factura as $detallesFactura)
                <p><b>Cliente:</b>{{ $detallesFactura->cliente->nombre }}</p>
                <p><b>#Factura:</b>{{ $detallesFactura->id }}</p>
                <p><b>#Cliente:</b>{{ $detallesFactura->fkCliente }}</p>
                <p><b>Ciudad:</b>{{ $detallesFactura->cliente->ciudad }}</p>
                <p><b>Fecha:</b>{{ $detallesFactura->created_at }}</p>
            @endforeach

            {{-- <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 5%">#</th>
                        <th style="width: 10%">#Producto</th> <!-- Ajuste de ancho de columna -->
                        <th style="width: 20%">Nombre</th> <!-- Ajuste de ancho de columna -->
                        <th style="width: 10%">Cantidad</th> <!-- Ajuste de ancho de columna -->
                        <th style="width: 10%">Valor</th> <!-- Ajuste de ancho de columna -->
                        <th style="width: 20%">% DCTO</th> <!-- Ajuste de ancho de columna -->

                        <th style="width: 15%">Subtotal</th> <!-- Ajuste de ancho de columna -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($detalles as $detalle)
                        <tr>
                            <td>{{ $detalle->fkFactura }}</td>
                            <td>{{ $detalle->fkProducto }}</td>
                            <td>{{ $detalle->nombre }}</td>
                            <td>{{ $detalle->cantidad }}</td>
                            <td>{{ $detalle->valor }}</td>
                            <td>0.00</td>
                            <td>{{ $detalle->subTotal }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table> --}}
                <table class="table"> <!-- Agregar la clase table-bordered para los bordes -->
            <thead class="table-dark">
                <tr class="tr">
                    <th style="width: 10%">#Codigo</th>
                    <th style="width: 20%">Descripcion</th>
                    <th style="width: 10%">Precio</th>
                    <th style="width: 10%">Cantidad</th>
                    <th style="width: 25%"> Descuento</th>
                    <th style="width: 15%">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total = 0; // Inicializa el total fuera del bucle
                @endphp
                @foreach ($detalles as $detalle)
                    <tr>
                        <td>{{ $detalle->fkProducto }}</td>
                        <td>{{ $detalle->nombre }}</td>
                        <td>{{ $detalle->valor }}</td>
                        <td>{{ $detalle->cantidad }}</td>
                        <td>0.00</td>
                        <td>{{ $detalle->subTotal }}</td>
                    </tr>
                    @php
                        $total += $detalle->subTotal; // Suma al total en cada iteración del bucle
                    @endphp
                @endforeach
            </tbody>
            <tfoot >
                <tr >
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>
                        <p><b>Total</b></p>
                    </th>
                    <th>
                        <p  style="margin-left: 10px; text-align: center"> <b>{{ $total }}</b></p> <!-- Muestra el total al final -->
                    </th>
                </tr>
            </tfoot>
        </table>
            {{-- <div class="col-md-11 text-end" id="total2" style="width: 100%">

                <h3>Total:{{ $detalle->total }}</h3>

            </div> --}}
            @foreach ($factura as $detalles)
                <a class="d-flex justify-content-end mb-3" href="{{ route('cliente.pdf', ['id' => $detalles->id]) }}"
                    class="btn btn-primary">
                    <i class="far fa-file-pdf"></i> Descargar PDF
                </a>
            @endforeach
        </div>
    </div>
    {{-- Agrega el enlace de Descargar PDF aquí --}}


@stop

@section('css')


    <style>
        .container {

            width: 70%;
            height: 100%;

            /* margin-top: 30px; */

        }

        .cont2 {

          
            padding: 40px;
         


        }

        h1 {
            margin-bottom: 20px;
        }

        table {
            width: 800px;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            vertical-align: middle;
            /* Centrar texto verticalmente */
        }

      .tr  th {
            background-color: #34495e;
        }

        /* Centrar contenido horizontalmente en las celdas */
        table td {
            text-align: center;
        }

        .empresa p {
            display: inline-block;
            margin-right: 20px;
        }

        /* .empresa::after {
                    content: "";
                    display: block;
                    clear: both;
                } */
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
        /* .tr tr{
            
            background-color: white;
        } */
    </style>
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>



    <script>
        $(document).ready(function() {

            let url = "{{ route('factura.buscarProductos') }}";
            cargarDatosTabla(url);
        });
    </script>

@stop

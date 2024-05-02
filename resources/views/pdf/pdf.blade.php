<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detalles de la Factura</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
        height: 100%;
            font-family: 'Roboto', sans-serif;
        }

        h1 {
            margin-bottom: 20px;
        }

        .table {
            margin-top: 30px;
            border-collapse: collapse;
            /* Añadimos esto para colapsar los bordes de la tabla */
        }

        .table2 {
            width: 120%;
            margin-top: -70px;
        }

        .table2 table th td {
            padding: 8px;
            text-align: left;
            vertical-align: middle;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            vertical-align: middle;
        }

        
        .table td {
            border: 1px solid #dee2e6;
            /* Añadimos un borde de 1px sólido */
        }

      .tr  th {
            background-color: #f2f2f2;
            border: 1px solid #dee2e6;
        }

        .table2 th {
            background-color: black;
        }

        .table {
            margin-top: 30px;
        }

        img {
            margin-top: 10px;
            width: 60%;
            height: 20vh;
            position: relative;
            right: 30px;
        }

        .head {
            position: absolute;
            bottom: 100%;
            left: 60px;
            width: 80%;

            padding: 10px;
            border-bottom: 1px solid #ccc;
            background-color: #f8f8f8;
        }

        .head p {
            position: relative;
            top: 15px;
            font-family: Arial, Helvetica, sans-serif;
        }

        .empresa p {
            margin: 10px;
            width: 300px;
            position: relative;
            right: 30px;
        }

        .empresa {
            display: block;
            margin-top: 40px;
            width: 70%;
        }

        .factura {
            margin-top: 60px;
            width: 60%;
        }

        .factura p {
            position: relative;
            bottom: 30px;
            margin: 10px;
        }

        .des {
            width: 100%;
            position: relative;
            right: 20px;
            margin-top: 30px;

        }

        .total {
            margin-top: 40px;
            width: 100%;
            position: relative;
            left: 0;
        }

        .firma {
            width: 80%;
            border-top: 1px solid black;
            /* padding-top: 20px; */
            margin-bottom: 0;
            /* Ajuste para eliminar el margen inferior */
        }

        .firma2 {
            width: 80%;
            border-top: 1px solid black;
            margin-left: 50px;
            /* padding-top: 20px; */
            margin-bottom: 0;
            /* Ajuste para eliminar el margen inferior */
        }

        .firma p {
            text-align: center;
        }

        .firmas {
            position: relative;
            top: 50px;
            left: 40px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="head">
            @foreach ($detalles as $detalle)
            <p>Documento:<b> Cotización - {{ $detalle->fkFactura }}</b></p>
            @endforeach
        </div>

        <div class="fila">
            <div>
                <div class="d-flex justify-content-end mb-3" id="img">
                    <img src="../public/img/logo.jpeg" alt="logo">
                </div>
            </div>
            <table class="table2">
                <tr>
                    <td class="empresa" colspan="2">
                        <p><b>Empresa:</b> Deposito el Nogal</p>
                        <p><b>Telefono:</b> 7242000 </p>
                        <p><b>Ciudad:</b> San Gil</p>
                        <p><b>Email:</b> contabilidad@depositoelnogal.com </p>
                        <p><b>Vendedor:</b> Jaime Suarez </p>
                        <p class="des">Nos complace hacerle llegar nuestra cotización por los
                            siguientes productos</p>
                    </td>
                    <td class="factura">
                        @foreach ($factura as $detallesFactura)
                            <p><b>Fecha:</b>{{ $detallesFactura->created_at }}</p>
                            <p><b>Cliente:</b>{{ $detallesFactura->cliente->nombre }} {{ $detallesFactura->cliente->apellido }}</p>
                            <p><b>NIT:</b> 900178252-9</p>
                        @endforeach
                    </td>
                </tr>
            </table>
        </div>

        {{-- <table class="table"> <!-- Agregar la clase table-bordered para los bordes -->
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
                @foreach ($detalles as $detalle)
                    <tr>
                        <td>{{ $detalle->fkProducto }}</td>
                        <td>{{ $detalle->nombre }}</td>
                        <td>{{ $detalle->valor }}</td>
                        <td>{{ $detalle->cantidad }}</td>
                 
                        <td>0.00</td>
                        <td>{{ $detalle->subTotal }}</td>
                    </tr>
                    
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>
                        <p><b>Total</b></p>
                    </th>
                    <th>
                        @foreach ($detalles as $detalle)
                            <p style="margin-left: 10px;"> <b>{{ $detalle->total }}</b></p>
                        @endforeach
                    </th>
                </tr>
            </tfoot>
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
            <tfoot>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>
                        <p><b>Total</b></p>
                    </th>
                    <th>
                        <p style="margin-left: 10px;"> <b>{{ $total }}</b></p> <!-- Muestra el total al final -->
                    </th>
                </tr>
            </tfoot>
        </table>
        
        <p><b>Método de Pago</b>: Contado</p>
        <p style="width: 60%">Cotización válida por 7 días <br>Factura sujeta a pagos trimestrales</p>

        <table class="firmas">
            <tr>
                <td class="firma" style="width: 100vh">
                    Vendedor: Jaime Suarez
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td class="firma2" style="width: 100vh"> <!-- Modificación aquí -->
                    Cliente:{{ $detallesFactura->cliente->nombre }} {{ $detallesFactura->cliente->apellido }}
                </td>
            </tr>
        </table>
    </div>
{{-- 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script> --}}
</body>

</html>

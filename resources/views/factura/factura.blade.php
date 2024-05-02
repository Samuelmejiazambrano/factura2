@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1> </h1>
@stop

@section('content')

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="{{ asset('js/factura.js') }}"></script>


    <h1>Factura</h1>


    <form action="{{ route('factura.create') }}" method="post">
        @csrf

        <div class="container-form">


            <div class="col-md-6" id="buscarCliente">
                <input style="width: 60vh " type="text" class="form-control iditem"
                    oninput="ajax_searchCliente(this.value, '{{ route('cliente.indexCliente') }}')"
                    placeholder="Buscar cliente...">
                <div class="productos-buttons-container">
                    <div id="cliente-buttons"></div>
                </div>
            </div>

            <div class="row">


                <div class="col-md-4">
                    <input type="hidden" class="form-control" name="fkcliente" id="idCliente" readonly>
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombreCliente" name="nombre" readonly>
                </div>
                <div class="col-md-4">
                    <label for="apellido" class="form-label">Apellido</label>
                    <input type="text" class="form-control" id="apellido" name="apellido" readonly>
                </div>
                <div class="col-md-4">
                    <label for="correo" class="form-label">Correo</label>
                    <input type="text" class="form-control" id="correo" name="correo" readonly>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="direccion" class="form-label">Dirección</label>
                    <input type="text" class="form-control" id="direccion" name="direccion" readonly>
                </div>
                <div class="col-md-4">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" id="telefono" name="telefono" readonly>
                </div>
                <div class="col-md-4">
                    <label for="ciudad" class="form-label">Ciudad</label>
                    <input type="text" class="form-control" id="ciudad" name="ciudad" readonly>
                </div>
            </div>




            {{-- <form action="{{ route('detalle.create') }}" method="post"> --}}
            <div
                class="container-fluid bg-warning-custom d-flex flex-column justify-content-center align-items-center h-100 container-form2">
                <div class="p-5 table-responsive table-form overflow-auto" id="producto" style="width: 120%">








                    <button type="button" class="btn bg-success text-white  " style="width: 30%;  height:50px;">
                        <a class="nav-link" href="/detalle">Detalle de factura</a>
                    </button>


                    @csrf
                    <input type="hidden" name="idFactura">
                    <table id="productos-table" class=" table-bordered text-white ">
                        <thead class="text-center" id="table">
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">nombre</th>

                                <th scope="col">valor</th>
                                <th scope="col">cantidad</th>
                                <th scope="col">sub Total</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>

                        <tbody class="text-center">
                            @if (session('message'))
                                <div id="alert" class="alert alert-success">
                                    {{ session('message') }}
                                </div>
                            @endif
                            @if (session('error'))
                                <div id="alert" class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif



                        </tbody>
                    </table>

                    <div class="row">
                        <div class="col-md-11 text-end" id="total2" style="width: 100%">

                            <h3>total:</h3>
                            <input style="font-size: 30px" type="number" name="total" id="totalInput" readonly>
                        </div>

                    </div>
                    <div class="d-flex justify-content-end mb-3" style="gap:10px ">
                        <button id="add-product-btn" class="btn btn-danger" type="button"
                            onclick="agregarFila('{{ route('factura.index') }}')">Añadir producto</button>

                        <input class="btn btn-primary" type="submit" value="enviar">
                        {{-- </form> --}}

                    </div>


    </form>





@stop

@section('css')
    <style>
        thead {
            background-color: #34495e;
            padding: 5px;
        }

        thead tr th {
            padding: 10px;
        }

        html,
        body {
            height: 100%;
        }

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

        .form input {
            width: 100%;
            border: 1px solid;
            /* Ancho del input al 100% */
        }

        .container-form {
            max-width: 800px;

            margin: auto;

            padding: 20px;
        }

        .container-form2 {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: auto;
            gap: 10px;
            padding: 20px;
            position: relative;

            bottom: 9vh;
            z-index: 1;
        }

        .container-form2 input {
            border: none;

            /* margin-top: 10px; */
        }

        h1 {
            margin-top: 50px;
            /* Espacio superior */
            text-align: center;
            /* Centrar el texto */
        }

        .buscar {
            display: flex;
            justify-content: center;
            /* Centrar horizontalmente */
            align-items: center;
            /* Centrar verticalmente */
            margin-bottom: 20px;
            width: 40vh;
            /* Espacio inferior */
        }

        .container {
            width: 80%;
            position: relative;
            /* Espacio alrededor del formulario */
            bottom: 4vh;
        }

        #opciones option {
            background-color: yellow;
            /* Cambia el color de fondo de las opciones */
            font-size: 80px;
            /* Ajusta el tamaño del texto */
        }


        #cliente-buttons {
            display: flex;
            flex-direction: column;
        }

        #cliente-buttons button {
            width: 30vh;
        }

        #buscarCliente {
            margin-bottom: 50px;
        }

        #buscarCliente input {
            border: 1px solid;
        }

        #productoscont {
            margin-bottom: 20px;
        }

        .productos-buttons-container {
            position: relative;
            width: 100%;
            margin-bottom: 20px;
        }

        #producto {
            display: flex;
            flex-direction: column;
            gap: 20px;
            position: relative;
            top: 40px;
        }

        #productos-buttons {
            display: flex;
            flex-direction: column;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            overflow-y: auto;
            max-height: 200px;
            z-index: 100;
            background-color: white;
        }

        #cliente-buttons {
            display: flex;
            flex-direction: column;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            overflow-y: auto;
            max-height: 200px;
            z-index: 100;
            background-color: white;
        }

        #total2 {
            display: flex;

            justify-content: flex-end;
            align-items: center;
            font-size: 20px;
            font-family: "Franklin Gothic Medium", "Arial Narrow", Arial, sans-serif;
            width: 150vh;
        }

        #total2 input {
            width: 20vh;
            height: 3vh;
            margin-bottom: 5px;
        }

        .nombre {
            height: 40px;
            padding: 10px;
            margin: 0px;
            /* display: flex;

            justify-content: center;
            align-items: center; */
        }

        tbody td {
            height: 40px;
        }
    </style>
@stop

@section('js')

    <!-- Agrega jQuery al final del cuerpo del documento -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script>
        $(document).ready(function() {
            let urlCliente = "{{ route('cliente.indexCliente') }}"
            let url = "{{ route('factura.index') }}"
            calcularSubtotal();

        });
    </script>


@stop

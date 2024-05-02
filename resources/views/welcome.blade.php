@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    {{-- <h1>Area de facturacion</h1> --}}
@stop

@section('content')
    {{-- <p>Welcome to this beautiful admin panel.</p> --}}
    <div class="container ">
        <div class="opciones">
            <div class="col-md-4">
                <a class="btn btn-primary" href="/cliente">
                    <i class="fa-solid fa-users"></i> Gestionar Clientes
                </a>
            </div>
            <div class="col-md-4">
                <a class="btn btn-secondary" href="/productos">
                    <i class="fa-solid fa-bars-progress"></i> Gestionar Productos
                </a>
            </div>
            <div class="col-md-4">
                <a class="btn btn-success" href="/venta">
                    <i class="fa-solid fa-cart-shopping"></i> Realizar Venta
                </a>
            </div>

        </div>
    </div>
@stop

@section('css')
    <style>
      
/* .opciones{
   position: relative;
   bottom: 20% ;
   display: flex;
          
} */

        .container {
            padding: 0;
            display: flex;
          flex-direction: row;
            justify-content: center;
            align-items: center;
           height: 100vh;

           
        }

        /* .col-md-4 a {
            display: block;
            width: 50vh;
          
            margin-bottom: 50px;
            height: 20vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;

        } */

    

   

        .navbar {
            background-color: #34495e;
        }

        .navbar-nav .nav-link {
            color: white !important;
            /* Importante para sobrescribir otros estilos */
        }

        .navbar-brand {
            color: white !important;
            /* Importante para sobrescribir otros estilos */
        }

        thead {
            background-color: #34495e;
        }
        .opciones {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.opciones .col-md-4 {
    margin: 0 20px; /* Espacio entre las columnas */
    flex: 1; /* Para que ocupen el mismo espacio */
    height: 200px; /* Ajusta la altura de las cajas según sea necesario */
}
.opciones .col-md-4 a {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    width: 100%; /* Ocupar todo el ancho disponible */
    height: 100%; /* Ocupar todo el alto disponible */
    padding: 20px;
    border-radius: 10px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Sombra suave */
    transition: transform 0.3s ease;
    text-decoration: none; /* Eliminar subrayado enlaces */
    color: #000; /* Color de texto */
}

.opciones .col-md-4 a:hover {
    transform: scale(1.05); /* Escalar ligeramente al pasar el mouse */
}

    </style>
@stop

@section('js')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz4fnFO9gybBud7TlRbs/ic4AwGcFZOxg5DpPt8EgeUIgIwzjWfXQKWA3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-gaQzF2D8RHJVsWpe8lGjH88sX/p8G5P86wYK2K9XDyJzqg15LQE/SduTvBQ48W" crossorigin="anonymous"></script>
    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");
    </script>
@stop

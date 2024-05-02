@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1 class="text-center"> Registrar Producto</h1>
@stop

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">




<div class="p-5 table-responsive text-center vh-100">
    <!-- Button trigger modal -->
    {{-- <div class="text-end mb-3 "> 
        @can('producto.crud.create')
            <button type="button" class="btn btn-primary btn btn-secondary  bg-success" data-bs-toggle="modal"
                data-bs-target="#exampleModal">
                Ingresa Nuevo Registro
            </button>
        @endcan
    </div> --}}
    <div class="d-flex justify-content-end mb-3"> <!-- Utilizamos d-flex y justify-content-end para alinear a la derecha -->
        <button type="button" class="btn btn-primary btn btn-secondary bg-success" data-bs-toggle="modal"
            data-bs-target="#exampleModal">
            Ingresa Nuevo Registro
        </button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content ">
                <div class="modal-header ">
                    <h5 class="modal-title justify-content-center" id="exampleModalLabel">Registrar Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('crud.create') }} " method="post">
                        @csrf

                        <div class="mb-2">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre">
                        </div>
                        <div class="mb-2">
                            <label for="cantidadDisponible" class="form-label">Cantidad Disponible</label>
                            <input type="text" class="form-control" id="cantidadDisponible"
                                name="cantidadDisponible">
                        </div>
                        <div class="mb-2">
                            <label for="valorUnico" class="form-label">Valor Único</label>
                            <input type="text" class="form-control" id="valorUnico" name="valorUnico">
                        </div>
                        <div class="mb-2">
                            <label for="estado" class="form-label">Estado</label>
                            <select class="form-select" id="estado" name="estado">
                                <option value="Activo">Activo</option>
                                <option value="Inactivo">Inactivo</option>
                            </select>
                        </div>

                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-secondary " data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <table class="table table-bordered border-dark">
        <thead class=" text-white">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Cantidad Disponible</th>
                <th scope="col">Valor Único</th>
                <th scope="col">Estado</th>
                {{-- @can('producto.crud.update') --}}
                <th>Editar</th>
                <th>Eliminar</th>
                {{-- @endcan --}}
            </tr>
        </thead>
        <tbody class="bg-light">
            @foreach ($datos as $item)
                <tr>
                    <th>{{ $item->id }}</th>
                    <td>{{ $item->nombre }}</td>
                    <td>{{ $item->cantidadDisponible }}</td>
                    <td>{{ $item->valorUnico }}</td>
                    <td>{{ $item->estado }}</td>

                    {{-- @can('producto.crud.update') --}}
                        <td> <a href="" data-bs-toggle="modal"
                                data-bs-target="#exampleModaleditar{{ $item->id }}"><i
                                    class="fa-solid fa-pen-to-square"></i></a></td>
                    {{-- @endcan --}}
                    {{-- @can('producto.crud.delete') --}}
                    <td>

                        <a href="{{ route('crud.delete', $item->id) }}" class="btn btn-danger"
                            onclick="return confirm('¿Estás seguro de eliminar este registro?')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                    {{-- @endcan --}}
                    <div class="modal fade" id="exampleModaleditar{{ $item->id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content ">
                                <div class="modal-header ">
                                    <h5 class="modal-title justify-content-center" id="exampleModalLabel">
                                        Modificar Producto</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('crud.update') }} " method="post">
                                        @csrf
                                        @method('put')

                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                        <div class="mb-2">
                                            <label for="nombre" class="form-label">Nombre</label>
                                            <input type="text" class="form-control" id="nombre"
                                                name="nombre" value="{{ $item->nombre }}">
                                        </div>
                                        <div class="mb-2">
                                            <label for="cantidadDisponible" class="form-label">Cantidad
                                                Disponible</label>
                                            <input type="text" class="form-control" id="cantidadDisponible"
                                                name="cantidadDisponible"
                                                value="{{ $item->cantidadDisponible }}">
                                        </div>
                                        <div class="mb-2">
                                            <label for="valorUnico" class="form-label">Valor Único</label>
                                            <input type="text" class="form-control" id="valorUnico"
                                                name="valorUnico" value="{{ $item->valorUnico }}">
                                        </div>
                                        <div class="mb-2">
                                            <label for="estado" class="form-label">Estado</label>
                                            <select class="form-select" id="estado" name="estado">
                                                <option value="Activo"
                                                    {{ $item->estado == 'Activo' ? 'selected' : '' }}>Activo
                                                </option>
                                                <option
                                                    value="Inactivo"{{ $item->estado == 'Inactivo' ? 'selected' : '' }}>
                                                    Inactivo</option>
                                            </select>
                                        </div>

                                </div>
                                <div class="modal-footer justify-content-center">
                                    <button type="submit" class="btn btn-secondary "
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </tr>
            @endforeach
        </tbody>
    </table>
    <nav aria-label="...">
        <ul class="pagination">

            <li class="page-item {{ $datos->previousPageUrl() ? '' : 'disabled' }}">
                <a class="page-link" href="{{ $datos->previousPageUrl() }}" tabindex="-1"
                    aria-disabled="true">Anterior</a>
            </li>

            @for ($i = 1; $i <= $datos->lastPage(); $i++)
                <li class="page-item {{ $datos->currentPage() == $i ? 'active' : '' }}">
                    <a class="page-link" href="{{ $datos->url($i) }}">{{ $i }}</a>
                </li>
            @endfor

            <li class="page-item {{ $datos->nextPageUrl() ? '' : 'disabled' }}">
                <a class="page-link" href="{{ $datos->nextPageUrl() }}">Siguiente</a>
            </li>
        </ul>
    </nav>
</div>



@stop

@section('css')
    <style>
      
.opciones{
   position: relative;
   bottom: 20% ;
   display: flex;
          
}

        .container {
            padding: 0;
            display: flex;
          flex-direction: row;
            justify-content: center;
            align-items: center;
           height: 100vh;

            /* Elimina el padding del contenedor */
        }

        .col-md-4 a {
            display: block;
            width: 50vh;
            /* Utiliza el 100% del ancho del contenedor padre */
            margin-bottom: 50px;
            height: 20vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;

        }

        .card {
            /* Elimina el ancho fijo */
            transition: transform 0.3s ease;
            padding: 10px;
            /* Agrega una transición de transformación con suavidad */
        }

        .card:hover {
            transform: scale(1.1);
            /* Escala el elemento al 110% cuando se hace hover */
        }

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
        h1 {
position: relative;
    top: 50px;
    text-align: center;
}
    </style>
@stop

@section('js')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");
    </script>
@stop

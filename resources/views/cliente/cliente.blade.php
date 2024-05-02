@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1> Registrar Cliente</h1>
@stop

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<div class="p-5 table-responsive text-center  vh-100">

    @can('cliente.create')
    <div class="d-flex justify-content-end mb-3"> <!-- Utilizamos d-flex y justify-content-end para alinear a la derecha -->
        <button type="button" class="btn btn-primary btn btn-secondary bg-success" data-bs-toggle="modal"
            data-bs-target="#exampleModal">
            Ingresa Nuevo Registro
        </button>
    </div>
      @endcan
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content ">
                <div class="modal-header ">
                    <h5 class="modal-title justify-content-center" id="exampleModalLabel">Registrar Usuario</h5>
                    <button type="button" class="btn-close btn-lg" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    <form action="{{ route('cliente.create') }}" method="post" class="row g-3">
                        @csrf
                        <div class="col-md-6""col-md-6">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre">
                        </div>
                        <div class="col-md-6">
                            <label for="apellido" class="form-label">Apellido</label>
                            <input type="text" class="form-control" id="apellido" name="apellido">
                        </div>
                        <div class="col-md-6">
                            <label for="correo" class="form-label">Correo</label>
                            <input type="text" class="form-control" id="correo" name="correo">
                        </div>
                        <div class="col-md-6">
                            <label for="direccion" class="form-label">Dirección</label>
                            <input type="text" class="form-control" id="direccion" name="direccion">
                        </div>
                        <div class="col-md-6">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" id="telefono" name="telefono">
                        </div>
                        <div class="col-md-6">
                            <label for="ciudad" class="form-label">Ciudad</label>
                            <input type="text" class="form-control" id="ciudad" name="ciudad">
                        </div>
                        <div class="col-md-6">
                            <label for="ciudad" class="form-label">Edad</label>
                            <input type="text" class="form-control" id="ciudad" name="edad">
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

    <table class=" table table-bordered border-dark ">
        <thead class="  text-white">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Edad</th>
                <th scope="col">Correo</th>
                <th scope="col">Dirección</th>
                <th scope="col">Teléfono</th>
                <th scope="col">Ciudad</th>
                
                @can('cliente.delete')
                <th>Editar</th>
                <th>Eliminar</th>
                @endcan
            </tr>
        </thead>
        <tbody class="bg-light ">
            @foreach ($datos2 as $item)
                <tr>
                    <th>{{ $item->id }}</th>
                    <td>{{ $item->nombre }}</td>
                    <td>{{ $item->apellido }}</td>
                    <td>{{ $item->edad }}</td>
                    <td>{{ $item->correo }}</td>
                    <td>{{ $item->direccion }}</td>
                    <td>{{ $item->telefono }}</td>
                    <td>{{ $item->ciudad }}</td>
                    @can('cliente.update')
                        <td> <a href="" data-bs-toggle="modal"
                                data-bs-target="#exampleModaleditar{{ $item->id }}"><i
                                    class="fa-solid fa-pen-to-square"></i></a></td>
                    @endcan
                    @can('cliente.delete')
                        <td>

                            <a href="{{ route('cliente.delete', $item->id) }}" class="btn btn-danger"
                                onclick="return confirm('¿Estás seguro de eliminar este registro?')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    @endcan
                    <div class="modal fade" id="exampleModaleditar{{ $item->id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title justify-content-center" id="exampleModalLabel">
                                        Modificar Usuario</h5>
                                        <button type="button" class="btn-close btn-lg" data-bs-dismiss="modal" aria-label="Close"></button>

                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('cliente.update') }}" method="POST"
                                        class="row g-3">
                                        @csrf
                                        @method('put')
                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="nombre" class="form-label">Nombre</label>
                                                <input type="text" class="form-control" id="nombre"
                                                    name="nombre" value="{{ $item->nombre }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="apellido" class="form-label">Apellido</label>
                                                <input type="text" class="form-control" id="apellido"
                                                    name="apellido" value="{{ $item->apellido }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="correo" class="form-label">Correo</label>
                                                <input type="text" class="form-control" id="correo"
                                                    name="correo" value="{{ $item->correo }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="direccion" class="form-label">Dirección</label>
                                                <input type="text" class="form-control" id="direccion"
                                                    name="direccion" value="{{ $item->direccion }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="telefono" class="form-label">Teléfono</label>
                                                <input type="text" class="form-control" id="telefono"
                                                    name="telefono" value="{{ $item->telefono }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="ciudad" class="form-label">Ciudad</label>
                                                <input type="text" class="form-control" id="ciudad"
                                                    name="ciudad" value="{{ $item->ciudad }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="ciudad" class="form-label">Edad</label>
                                                <input type="text" class="form-control" id="edad"
                                                    name="edad" value="{{ $item->edad }}">
                                            </div>
                                        </div>
                                </div>
                                <div class="modal-footer justify-content-center">
                                    <button type="submit" class="btn btn-secondary"
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
            <!-- Mostrar el enlace "Anterior" -->
            <li class="page-item {{ $datos2->previousPageUrl() ? '' : 'disabled' }}">
                <a class="page-link" href="{{ $datos2->previousPageUrl() }}" tabindex="-1"
                    aria-disabled="true">Anterior</a>
            </li>
            <!-- Mostrar los números de página -->
            @for ($i = 1; $i <= $datos2->lastPage(); $i++)
                <li class="page-item {{ $datos2->currentPage() == $i ? 'active' : '' }}">
                    <a class="page-link" href="{{ $datos2->url($i) }}">{{ $i }}</a>
                </li>
            @endfor
            <!-- Mostrar el enlace "Siguiente" -->
            <li class="page-item {{ $datos2->nextPageUrl() ? '' : 'disabled' }}">
                <a class="page-link" href="{{ $datos2->nextPageUrl() }}">Siguiente</a>
            </li>
        </ul>
    </nav>
</div>



       
@stop

@section('css')
        <style>
          
          .form-label {
    display: flex;
    justify-content: start;
    align-items: center;
}

h1 {
position: relative;
    top: 50px;
    text-align: center;
}

.navbar {
    background-color: #34495e;
    color: white;

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

table td {
    font-family: Verdana, Geneva, Tahoma, sans-serif
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

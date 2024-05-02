@extends('adminlte::auth.auth-page')

@section('auth_body')
   
        {{-- <div class="card-body login-card-body" > --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <p class="login-box-msg">Iniciar sesión para comenzar tu sesión</p>

            <form action="{{ route('login.login') }}" method="POST">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Nombre de Usuario" name="name">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Contraseña" name="password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
                        <p   class="text-center" style="margin-top:20px">No tienes cuenta? <a href="/registro">Regístrate</a></p>
                    </div>
                </div>
            </form>
        {{-- </div> --}}
        <!-- /.login-card-body -->
   
    <!-- /.card -->
@endsection

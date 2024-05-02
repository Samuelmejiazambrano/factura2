@extends('adminlte::auth.auth-page')

@section('auth_body')
   
<form action="{{ route('register.register') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Correo Electrónico</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>

    <div class="mb-3">
        <label for="rol" class="form-label">Rol:</label>
        <select class="form-control" id="rol" name="rol" required>
            <option value=""></option>
            <option value="administrador">Administrador</option>
            <option value="empleado">Empleado</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Contraseña</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <div class="mb-3">
        <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
            required>
    </div>
    <div class="button-container">
        <button id="button" type="submit" class="btn btn-primary">Registrarse</button>
        <a href="/login">Ya tienes cuenta?</a>
    </div>
</form>
@endsection

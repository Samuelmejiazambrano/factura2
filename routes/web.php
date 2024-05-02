<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\LoginController;
use App\Http\Middleware\PermissionMiddleware;




Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();


Route::middleware(['auth'])->group(function () {

    Route::get('productos/index', [ProductoController::class, "index"])->middleware('permisos:producto.crud.index');
    Route::get('cliente', [ClienteController::class, "index"])->middleware('permisos:cliente.index');
    Route::get('factura', [FacturaController::class, "index"])->name("factura.index")->middleware('permisos:cliente.index');
    Route::post('productos/create', [ProductoController::class, "create"])->name("crud.create")->middleware('permisos:producto.crud.create');
    Route::put('productos/modificar', [ProductoController::class, "update"])->name("crud.update")->middleware('permisos:producto.crud.update');
    Route::get('productos/{id_producto}', [ProductoController::class, "delete"])->name("crud.delete")->middleware('permisos:producto.crud.delete');
    Route::get('cliente', [ClienteController::class, "index"])->name("cliente.index")->middleware('permisos:cliente.index');
    Route::post('cliente', [ClienteController::class, "create"])->name("cliente.create")->middleware( 'permisos:cliente.create');
    Route::put('cliente/modificar', [ClienteController::class, "update"])->name("cliente.update")->middleware('permisos:cliente.update');
    Route::get('cliente/{idCliente}', [ClienteController::class, "delete"])->name("cliente.delete")->middleware('permisos:cliente.delete');
    Route::get('factura/cliente', [FacturaController::class, "indexCliente"])->name("factura.indexCliente")->middleware( 'permisos:factura.indexCliente');
    Route::get('factura/producto', [FacturaController::class, "buscarProductos"])->name("factura.buscarProductos")->middleware( 'permisos:factura.buscarProductos');
    Route::get('mostrarDetalle{id}', [FacturaController::class, 'mostrarDetalle'])->name('factura.mostrarDetalle')->middleware( 'permisos:factura.mostrarDetalle');
    Route::post('factura/create', [FacturaController::class, "create"])->name("factura.create")->middleware( 'permisos:factura.create');
    ;
    Route::get('factura/cliente', [ClienteController::class, "indexCliente"])->name("cliente.indexCliente");
    Route::get('detalle', [FacturaController::class, "indexDetalle"])->name("cliente.indexDetalle")->middleware('permisos:factura.cliente.indexDetalle');
    Route::get('pdf/{id}', [FacturaController::class, "pdf"])->name("cliente.pdf")->middleware('permisos:factura.cliente.pdf');


});

    Route::get('welcome/', function () {
        return view('welcome');
    });
    Route::post('registro', [RegisterController::class, "register"])->name("register.register");
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/', function () {
    return view('layouts.login');
})->name('login');
Route::post('/login', [App\Http\Controllers\LoginController::class, "login"])->name("login.login");

Route::get('/registro', function () {
    return view('registro.registro');
})->name('register.register');












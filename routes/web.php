<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\FacturaCompraController;
use App\Http\Controllers\PromocionController;
use App\Http\Controllers\ProductoMotoController;

Route::resource('productos_moto', ProductoMotoController::class);
Route::resource('promociones', PromocionController::class);

// ... (todas tus rutas existentes) ...

// ----------- FACTURAS DE COMPRA (NUEVA SECCIÓN) -----------
// Esta línea crea automáticamente todas las rutas RESTful para FacturaCompraController
Route::resource('facturas-compra', FacturaCompraController::class);
// Ruta para el menú principal
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// ----------- CLIENTES -----------
Route::get('/cliente/menu', function () {
    return view('cliente.menu');
})->name('cliente.menu');

Route::get('/cliente/autocomplete', [ClienteController::class, 'autocomplete'])->name('cliente.autocomplete');

Route::resource('cliente', ClienteController::class);

// ----------- EMPLEADOS -----------
Route::get('/empleados/menu', function () {
    return view('empleados.menu');
})->name('empleados.menu');

Route::resource('empleados', EmpleadoController::class);

// ----------- PROVEEDORES -----------
Route::get('/proveedores/menu', function () {
    return view('proveedores.menu');
})->name('proveedores.menu');

Route::resource('proveedores', ProveedorController::class);

// ----------- PRODUCTOS -----------
Route::get('/productos/menu', function () {
    return view('productos.menu');
})->name('productos.menu');

Route::resource('productos', ProductoController::class);

// ----------- FACTURAS -----------
Route::get('/facturas/menu', function () {
    return view('facturas.menu');
})->name('facturas.menu');

Route::resource('facturas', FacturaController::class)->except(['edit', 'update', 'destroy']);

// Ruta adicional si quieres una selección general de operaciones
Route::get('/seleccionar-operacion', function () {
    return view('seleccion');
})->name('seleccion.operacion');

// En routes/web.php
Route::resource('facturas', FacturaController::class);


<?php

use App\Http\Controllers\LubricanteController;
use App\Http\Controllers\ProductoMotoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\FacturaCompraController;
use App\Http\Controllers\PromocionController;
use App\Http\Controllers\SearchController; // Importa el nuevo controlador

// ----------- RUTAS PRINCIPALES Y MENÚ -----------

// Ruta para el menú principal (Raíz del sitio)
Route::get('/', function () {
    return view('welcome');
})->name('welcome'); // <-- Nombre de ruta: 'welcome'

// Ruta adicional si quieres una selección general de operaciones
Route::get('/seleccionar-operacion', function () {
    return view('seleccion');
})->name('seleccion.operacion');

// Ruta de Historia y Valores
Route::view('/nuestra-historia', 'historia.historia')->name('about');


// ----------- RECURSOS Y SISTEMAS -----------

// Facturas de Compra
Route::resource('facturas-compra', FacturaCompraController::class);

// Promociones
Route::resource('promociones', PromocionController::class);

// Clientes
Route::get('/cliente/menu', function () {
    return view('cliente.menu');
})->name('cliente.menu');
Route::get('/cliente/autocomplete', [ClienteController::class, 'autocomplete'])->name('cliente.autocomplete');
Route::resource('cliente', ClienteController::class);

// Empleados
Route::get('/empleados/menu', function () {
    return view('empleados.menu');
})->name('empleados.menu');
Route::resource('empleados', EmpleadoController::class);

// Proveedores
Route::get('/proveedores/menu', function () {
    return view('proveedores.menu');
})->name('proveedores.menu');
Route::resource('proveedores', ProveedorController::class);

// Productos
Route::get('/productos/menu', function () {
    return view('productos.menu');
})->name('productos.menu');
Route::resource('productos', ProductoController::class);

// Actualiza la ruta para usar el nuevo controlador de búsqueda
Route::get('/buscar', [SearchController::class, 'results'])->name('search.results');

// Facturas de Venta
Route::get('/facturas/menu', function () {
    return view('facturas.menu');
})->name('facturas.menu');

Route::resource('facturas', FacturaController::class);

// Lubricantes
Route::resource('lubricantes', LubricanteController::class);

Route::resource('productos_moto', ProductoMotoController::class);
Route::resource('promociones', PromocionController::class);

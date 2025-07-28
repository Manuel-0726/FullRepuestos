<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
use App\Http\Controllers\ProveedorController;

Route::resource('proveedores', ProveedorController::class);
Route::get('proveedores/{proveedor}', [ProveedorController::class, 'show'])->name('proveedores.show');

Route::get('/', function () {
    return view('welcome');
});

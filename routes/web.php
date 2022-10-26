<?php

use App\Http\Controllers\ConsumoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\RepuestoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Consumo
Route::get('/consumo', [ConsumoController::class, 'index'])->name('consumo');
Route::get('/consumo/create', [ConsumoController::class, 'create'])->name('consumo.crear');
Route::post('/consumo/store', [ConsumoController::class, 'save'])->name('consumo.almacenar');

Route::get('/consumo/edit/{consumo}', [ConsumoController::class, 'edit'])->name('consumo.editar');
Route::post('/consumo/update/{consumo}', [ConsumoController::class, 'update'])->name('consumo.actualizar');
Route::post('/consumo/delete/', [ConsumoController::class, 'delete'])->name('consumo.eliminar');

// Proveedor
Route::get('/datos/proveedor', [ProveedorController::class, 'index'])->name('proveedor');
Route::get('/datos/proveedor/create', [ProveedorController::class, 'create'])->name('proveedor.crear');
Route::post('/datos/proveedor/store', [ProveedorController::class, 'save'])->name('proveedor.almacenar');

Route::get('/datos/proveedor/edit/{proveedor}', [ProveedorController::class, 'edit'])->name('proveedor.editar');
Route::post('/datos/proveedor/update/{proveedor}', [ProveedorController::class, 'update'])->name('proveedor.actualizar');
Route::post('/datos/proveedor/delete/', [ProveedorController::class, 'delete'])->name('proveedor.eliminar');

// Equipo
Route::get('/datos/equipo', [EquipoController::class, 'index'])->name('equipo');
Route::get('/datos/equipo/create', [EquipoController::class, 'create'])->name('equipo.crear');
Route::post('/datos/equipo/store', [EquipoController::class, 'save'])->name('equipo.almacenar');

Route::get('/datos/equipo/edit/{equipo}', [EquipoController::class, 'edit'])->name('equipo.editar');
Route::post('/datos/equipo/update/{equipo}', [EquipoController::class, 'update'])->name('equipo.actualizar');
Route::post('/datos/equipo/delete/', [EquipoController::class, 'delete'])->name('equipo.eliminar');

// Repuestos
Route::get('/datos/repuesto', [RepuestoController::class, 'index'])->name('repuesto');
Route::get('/datos/repuesto/create', [RepuestoController::class, 'create'])->name('repuesto.crear');
Route::post('/datos/repuesto/store', [RepuestoController::class, 'save'])->name('repuesto.almacenar');

Route::get('/datos/repuesto/edit/{repuesto}', [RepuestoController::class, 'edit'])->name('repuesto.editar');
Route::post('/datos/repuesto/update/{repuesto}', [RepuestoController::class, 'update'])->name('repuesto.actualizar');
Route::post('/datos/repuesto/delete/', [RepuestoController::class, 'delete'])->name('repuesto.eliminar');

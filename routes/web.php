<?php

use App\Http\Controllers\ConsumoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IngresoController;
use App\Http\Controllers\LlantaController;
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

Route::get('/', [HomeController::class, 'index']);

// Consumo
Route::get('/consumo', [ConsumoController::class, 'index'])->name('consumo');
Route::get('/consumo/create', [ConsumoController::class, 'create'])->name('consumo.crear');
Route::post('/consumo/store', [ConsumoController::class, 'save'])->name('consumo.almacenar');

Route::get('/consumo/edit/{consumo}', [ConsumoController::class, 'edit'])->name('consumo.editar');
Route::post('/consumo/update/{consumo}', [ConsumoController::class, 'update'])->name('consumo.actualizar');
Route::post('/consumo/delete/', [ConsumoController::class, 'delete'])->name('consumo.eliminar');

Route::get('/consumo/consumir/{consumo}', [ConsumoController::class, 'consumir'])->name('consumo.consumir');
Route::post('/consumo/guardar/ingreso/{consumo}',[ConsumoController::class, 'guardarConsumo'])->name('consumo.guardarConsumo');

Route::post('/consumo/data/vale_no_consumido',[ConsumoController::class, 'returnValeSinConsumir'])->name('consumo.consumido.no');
Route::post('/consumo/data/vale_consumido',[ConsumoController::class, 'returnValeConsumido'])->name('consumo.consumido.si');

Route::post('/consumo/data/cantidad_ingreso',[IngresoController::class, 'retornarCantidadRepuesto'])->name('consumo.ingreso.cantidad');

// Detalles
Route::post('/consumo/data/detalles',[ConsumoController::class, 'detallesConsumo'])->name('consumo.detalles');

// Ingreso
Route::get('/ingreso', [IngresoController::class, 'index'])->name('ingreso');
Route::get('/ingreso/create', [IngresoController::class, 'create'])->name('ingreso.crear');
Route::post('/ingreso/store', [IngresoController::class, 'save'])->name('ingreso.almacenar');

Route::get('/ingreso/edit/{ingreso}', [IngresoController::class, 'edit'])->name('ingreso.editar');
Route::post('/ingreso/update/{ingreso}', [IngresoController::class, 'update'])->name('ingreso.actualizar');
Route::post('/ingreso/delete/', [IngresoController::class, 'delete'])->name('ingreso.eliminar');


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

// Llantas
Route::get('/datos/llanta', [LlantaController::class, 'index'])->name('llanta');
Route::get('/datos/llanta/create', [LlantaController::class, 'create'])->name('llanta.crear');
Route::post('/datos/llanta/store', [LlantaController::class, 'save'])->name('llanta.almacenar');

Route::get('/datos/llanta/edit/{llanta}', [LlantaController::class, 'edit'])->name('llanta.editar');
Route::post('/datos/llanta/update/{llanta}', [LlantaController::class, 'update'])->name('llanta.actualizar');
Route::post('/datos/llanta/delete/', [LlantaController::class, 'delete'])->name('llanta.eliminar');

Auth::routes([
    'register' => false,
  'reset' => false,
  'verify' => false,
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\DniController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\PlantillaController;
use App\Http\Controllers\ValidarController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\TipoplantillaController;
use App\Http\Controllers\LaboralController;
use App\Http\Controllers\RemuneracionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProfileController;

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

Route::get('/', [HomeController::class, 'index'])->name('panel');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::resource('personas', PersonaController::class);
Route::resource('plantillas', PlantillaController::class);
Route::resource('cargos', CargoController::class);
Route::resource('contratos', ContratoController::class);
Route::resource('tipoplantillas', TipoplantillaController::class);
Route::resource('laborales', LaboralController::class);
Route::resource('remuneraciones', RemuneracionController::class);
Route::resource('roles', RoleController::class);
Route::resource('users', UserController::class);
Route::resource('profile', ProfileController::class);

Route::get('/consultar-dni/{dni}', [DniController::class, 'consultarDni'])->name('consultar-dni');
Route::get('/buscar-existente/{persona}/{mes}/{anio}/{tipPlant}', [ValidarController::class, 'buscarExistente'])->name('buscar-existente');
Route::get('/buscar-valores/{persona}/{mes}/{anio}', [ValidarController::class, 'buscarValores'])->name('buscar-valores');

Route::get('/detalle-trabajador/{idPer}/{idPlan}', [PlantillaController::class, 'verDetalleTrabajador'])->name('detalle-trabajador');
Route::get('/eliminar-trabajador/{idPer}/{idPlan}', [PlantillaController::class, 'eliminarPersona'])->name('eliminar-trabajador');
Route::get('/exportar-plantilla/{id}', [PlantillaController::class, 'exportPlantilla'])->name('exportar-plantilla');
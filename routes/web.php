<?php

use App\Http\Controllers\controladorProducto;
use App\Http\Controllers\controladorUsuario;
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

// Route::get('/', function () {
//     return view('welcome');
// })->name('index');




//Rutas generales
Route::get('/' , [controladorProducto::class,'index'])->name("index");




//Navegar sobre los formularios
Route::view("/registro","auth.registro")->name("registro");



//Enviar y cargar un metodo
Route::post("/registrar",[controladorUsuario::class,'store'])->name("auth.registrar");

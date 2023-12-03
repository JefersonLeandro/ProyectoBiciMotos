<?php

use App\Http\Controllers\auth\controladorRegistrarUsuario;
use App\Http\Controllers\auth\controladorAutenticarUsuario;
use App\Http\Controllers\controladorProducto;
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



// Route::middleware(['web'])->group(function () {

    //Rutas generales
    Route::get('/' , [controladorProducto::class,'index'])->name("index");




    //Navegar sobre los formularios
    Route::view("/registro","auth.registro")->name("registro");
    Route::view("/login","auth.login")->name("login");



    //Enviar y cargar un metodo
    Route::post("/registrar",[controladorRegistrarUsuario::class,'store'])->name("auth.Registrar");
    Route::post("/autenticarUsuario",[controladorAutenticarUsuario::class,'store'])->name("auth.Usuario");
// });



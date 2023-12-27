<?php

use App\Http\Controllers\auth\controladorRegistrarUsuario;
use App\Http\Controllers\auth\controladorAutenticarUsuario;
use App\Http\Controllers\controladorProducto;
use App\Http\Controllers\controladorCarrito;
use App\Http\Controllers\controladorFactura;
use App\Http\Controllers\tablas\controladorTablaDetallesFactura;
use App\Http\Controllers\tablas\controladorTablaFactura;
use App\Http\Controllers\tablas\controladorTablaRoles;
use App\Http\Controllers\tablas\controladorTablaUsuario;
use App\Http\Controllers\tablas\controladorTablaImagen;
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


    //Navegar sobre los formularios , vistas o indexar
    Route::view("/registro","auth.registro")->name("registro");
    Route::view("/login","auth.login")->name("login");
    Route::get("/carrito",[controladorCarrito::class,'index'])->name("carrito");
    Route::get("/administracion",[controladorTablaUsuario::class,'index'])->name("areaAdmin");
    Route::get("/Roles",[controladorTablaRoles::class,'index'])->name("tablaRoles");
    Route::get("/Productos",[controladorProducto::class,'indexTablaProducto'])->name("tablaProducto");
    Route::get("/imgs",[controladorTablaImagen::class,'index'])->name("tablaImagen");
    Route::get("/facturas",[controladorTablaFactura::class,'index'])->name("tablaFactura");
    Route::get("/detallesFactura",[controladorTablaDetallesFactura::class,'index'])->name("tablaDetallesFactura");
    
    
    //Enviar y cargar un metodo
    Route::post("/registrar",[controladorRegistrarUsuario::class,'store'])->name("auth.Registrar");
    Route::post("/autenticarUsuario",[controladorAutenticarUsuario::class,'store'])->name("auth.Usuario");
    Route::post("/logout",[controladorAutenticarUsuario::class,'destroy'])->name("auth.logout");
    Route::post("/agregarCarrito/{idProducto}",[controladorCarrito::class,'store'])->name("agregarCarrito");
    Route::post("/eliminarCarrito/{idCarrito}",[controladorCarrito::class,'eliminarUnCarrito'])->name("eliminarCarrito");
    Route::get("/actualizarCarrito",[controladorCarrito::class,'actualizarCarrito'])->name("actualizarCarrito");
    Route::get("/factura",[controladorFactura::class,'index'])->name("factura");

    Route::post("/crudUsuario",[controladorTablaUsuario::class,'opciones'])->name("crudUsuario");


    // Route::get("/Factura",[controladorFactura::class,'insertarF'])->name("actualizarCarrito");
    




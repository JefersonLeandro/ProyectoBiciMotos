<?php

namespace App\Http\Controllers;


use App\Models\carritoCompra;
use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;

class controladorProducto extends Controller
{

    public function index(){

        $productos = Producto::get();

        if(Auth::user()){

            $numeroCarritos = $this->obtenerTamanoCarrito();
            
            return view('index', ['productos' => $productos ,'tamanoCarrito'=>$numeroCarritos]);
        }
       
        return view('index', ['productos' => $productos]);
    
    }



    public function obtenerTamanoCarrito(){

        $idUsuario = Auth::user()->idUsuario;
        $tamanoCarrito = carritoCompra::where('idUsuario', $idUsuario)->count();
        return $tamanoCarrito;
    }
}
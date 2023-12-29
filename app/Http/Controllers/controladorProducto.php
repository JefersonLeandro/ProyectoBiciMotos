<?php

namespace App\Http\Controllers;


use App\Models\carritoCompra;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Imagen;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class controladorProducto extends Controller
{
    
    public function index(){


        //SELECT productos.idProducto , productos.nombreProducto , productos.descripcionProducto,  productos.precioProducto ,productos.stockProducto, imagenes.nombreImagen FROM productos 
        //INNER JOIN imagenes on productos.idProducto = imagenes.idProducto WHERE tipoImagen=0;
        
        

        // $productos = Producto::get();

        $productos = DB::table('productos')
                ->join('imagenes', 'productos.idProducto', '=', 'imagenes.idProducto')
                ->where('tipoImagen', '=',0 )
                ->select('imagenes.nombreImagen', 'productos.idProducto','productos.nombreProducto','productos.descripcionProducto', 'productos.precioProducto', 'productos.stockProducto')
                ->get();

        if(Auth::user()){

            $numeroCarritos = $this->obtenerTamanoCarrito();
            
            return view('index', ['productos' => $productos ,'tamanoCarrito'=>$numeroCarritos]);
        }
       
        return view('index', ['productos' => $productos]);
    
    }


    public function indexTablaProducto(){

       


        
        return view('tablas.tablaProducto');

    }


    public function obtenerTamanoCarrito(){

        $idUsuario = Auth::user()->idUsuario;
        $tamanoCarrito = carritoCompra::where('idUsuario', $idUsuario)->count();
        return $tamanoCarrito;
    }


    
}
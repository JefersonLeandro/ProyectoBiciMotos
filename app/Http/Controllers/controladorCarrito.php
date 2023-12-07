<?php

namespace App\Http\Controllers;

use App\Models\carritoCompra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class controladorCarrito extends Controller
{
    
    public function index(){

        // SELECT productos.idProducto, productos.nombreProducto, productos.precioProducto ,productos.stockProducto FROM productos 
        // INNER JOIN carritocompras ON productos.idProducto = carritocompras.idProducto WHERE carritocompras.idUsuario=1;

        if(Auth::user()){

            $idUsuario = Auth::user()->idUsuario;
            //tamanoCarrito
            $controladorProducto = new controladorProducto();
            $tamanoCarrito = $controladorProducto->obtenerTamanoCarrito();

            
            //innerJoin para la informacion , falta agregar logica para la --IMAGEN--
            $informacionCarrito = DB::table('productos')
                ->join('carritoCompras' ,'productos.idProducto', '=' ,'carritoCompras.idProducto')
                ->where('carritoCompras.idUsuario','=',$idUsuario)
                ->select('productos.idProducto','productos.nombreProducto','productos.precioProducto','productos.stockProducto')
                ->get();
                
            return $informacionCarrito;
            return view("carritoCompras" , ['tamanoCarrito' =>$tamanoCarrito]);
        }
        return view("carritoCompras");
      
    }
    public function store(Request $request){

        //insertar
        //null,idProducto,idUsuario
      

        carritoCompra::create([

            "idProducto"=> $request->idProducto,
            "idUsuario"=> Auth::user()->idUsuario,

        ]);

        return back();
    }

    public function obtenerTamanoCarrito(){


        return "alsdjalsdf";
    }


}

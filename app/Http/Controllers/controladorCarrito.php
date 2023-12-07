<?php

namespace App\Http\Controllers;

use App\Models\carritoCompra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mockery\Undefined;

class controladorCarrito extends Controller
{
    
    public function index(){

        // SELECT carritocompras.idCarritoCompra , productos.idProducto, productos.nombreProducto, productos.precioProducto ,productos.stockProducto FROM productos 
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
                ->select('carritoCompras.cantidadCarrito','carritoCompras.idCarritoCompra','productos.idProducto','productos.nombreProducto','productos.precioProducto','productos.stockProducto')
                ->get();
                
            return view("carritoCompras" , ['tamanoCarrito' =>$tamanoCarrito, 'informacionCarrito'=>$informacionCarrito]);
        }
        return view("carritoCompras");
      
    }
    public function store(Request $request){


        $idProducto = $request->idProducto;
        $verificacion = false;
        

        $carritos = carritoCompra::get();

        if($carritos->isEmpty()){

           $this->insertarCarrito($request);

        }else{

            foreach($carritos as $carrito){
    
                
    
                if($idProducto == $carrito->idProducto){ //2 [1,3,3,3]  // 2 [1,3,2,3,2]

                    $verificacion = true;

                }
    
            }

            if($verificacion){

                 $this->actualizarCantidadCarrito($request);

            }else{

                 $this->insertarCarrito($request);

            }

        }

        return back();
    }

    public function actualizarCantidadCarrito(Request $request){

        //update de la cantidad carrito en +1 , obtengo la cantidad le sumo uno y la actualizo.

        $idProducto = $request->idProducto;
        $findCarrito = carritoCompra::where('idProducto',$idProducto)->firstOrFail();//encuentra el registro con el idProducto
        $cantidadCarrito =  $findCarrito->cantidadCarrito + 1;//se le suma 1 para actualizar la cantidad

     

        $findCarrito ->update([//se actualiza el registro encontrado

            "cantidadCarrito" =>$cantidadCarrito,
        ]);


    }

    public function insertarCarrito(Request $request){

        carritoCompra::create([

            "idProducto"=> $request->idProducto,
            "idUsuario"=> Auth::user()->idUsuario,
            "cantidadCarrito"=>1,
        ]);

    }

   

}

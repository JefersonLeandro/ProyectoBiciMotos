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
        $idUsuario = Auth::user()->idUsuario;
        
        $verificacion = false;
        

        $carritos = carritoCompra::where('idUsuario',$idUsuario)->get();

     
        
        if($carritos->isEmpty()){

           $this->insertarCarrito($request);

        }else{

            foreach($carritos as $carrito){
    
                if($idProducto == $carrito->idProducto){ //2 [1,3,3,3]  // 2 [1,3,2,3,2]

                    $verificacion = true;

                }
    
            }

            if($verificacion){

                 $this->actualizarCantidadCarrito($request ,$idUsuario,$idProducto);

            }else{

                 $this->insertarCarrito($request);

            }

        }

        return back();
    }

    public function actualizarCantidadCarrito(Request $request, $idUsuario, $idProducto){

   
       
        //update de la cantidad carrito en +1 , obtengo la cantidad le sumo uno y la actualizo.

        // SELECT carritocompras.idCarritoCompra, carritocompras.idProducto, carritocompras.idUsuario , carritocompras.cantidadCarrito, productos.stockProducto FROM productos
        // INNER JOIN carritocompras ON productos.idProducto = carritocompras.idProducto WHERE carritocompras.idUsuario =1 and productos.idProducto=2;

        $carritoEncontrado = DB::table('productos')//encontrar un carrito especificamente con el stock del producto
            ->join('carritocompras','productos.idProducto','=','carritocompras.idProducto')
            ->where('carritocompras.idUsuario','=',$idUsuario)
            ->where('carritocompras.idProducto','=',$idProducto)
            ->select('carritocompras.idCarritoCompra','carritocompras.idProducto','carritocompras.idUsuario','carritocompras.cantidadCarrito','productos.stockProducto')
            ->first();

           
            $idCarritoEncontrado= $carritoEncontrado->idCarritoCompra;
            $stockProducto = $carritoEncontrado->stockProducto;//12
            $cantidadCarrito = $carritoEncontrado->cantidadCarrito+1;//8 , //se le suma 1 para actualizar la cantidad

            if($cantidadCarrito <= $stockProducto){

                DB::table('carritocompras')//utilizar la consulta del inner join ya realizada
                ->where('idCarritoCompra', $idCarritoEncontrado)
                ->update(['cantidadCarrito' => $cantidadCarrito]); //se actualiza la cantidad
                
            }else{
                //no se actualiza la cantidad y se manda un mensaje producto fuera de stock 
                return back()->with('estado','producto fuera de stock');
            }
       
       
        // $findCarrito = carritoCompra::where([

        //     'idProducto'=>$idProducto,
        //     'idUsuario'=>$idUsuario,

        // ])->firstOrFail();//encuentra el registro con el idProducto y el idUsuario


    }

    public function insertarCarrito(Request $request){

        carritoCompra::create([

            "idProducto"=> $request->idProducto,
            "idUsuario"=> Auth::user()->idUsuario,
            "cantidadCarrito"=>1,
        ]);

    }

    public function eliminarUnCarrito(Request $request , $idCarritoCompra){


        $findCarrito = carritoCompra::findorfail($idCarritoCompra); 

        $findCarrito->delete();
        return back();

    }
   

}

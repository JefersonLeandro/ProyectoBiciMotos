<?php

namespace App\Http\Controllers;

use App\Models\carritoCompra;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mockery\Undefined;

class controladorCarrito extends Controller
{

    public function index()
    {

        // SELECT carritocompras.idCarritoCompra , productos.idProducto, productos.nombreProducto, productos.precioProducto ,productos.stockProducto FROM productos 
        // INNER JOIN carritocompras ON productos.idProducto = carritocompras.idProducto WHERE carritocompras.idUsuario=1;

        if (Auth::user()) {

            $idUsuario = Auth::user()->idUsuario;

            //tamanoCarrito
            $controladorProducto = new controladorProducto();
            $tamanoCarrito = $controladorProducto->obtenerTamanoCarrito();


            //innerJoin para la informacion , falta agregar logica para la --IMAGEN--
            $informacionCarrito = DB::table('productos')
                ->join('carritoCompras', 'productos.idProducto', '=', 'carritoCompras.idProducto')
                ->where('carritoCompras.idUsuario', '=', $idUsuario)
                ->select('carritoCompras.idCarritoCompra', 'productos.idProducto','productos.nombreProducto','carritoCompras.cantidadCarrito', 'productos.precioProducto', 'productos.stockProducto')
                ->get();

                
                // return $informacionCarrito;
            //comprobacion para cuando el stock de un producto quede en cero 
            $productosAgotados = [];
            $agotado = false;

            foreach ($informacionCarrito as $carrito) {

                $stockProducto = $carrito->stockProducto;
                $idCarrito = $carrito->idCarritoCompra;

                if($stockProducto == 0){
                    // return $idCarrito;
                    DB::table('carritocompras') //utilizar la consulta del inner join ya realizada
                    ->where('idCarritoCompra', $idCarrito)
                    ->delete();
                    
                    $productosAgotados[] = [
                        'nombreProducto' => $carrito->nombreProducto,
                        'precioProducto' => $carrito->precioProducto
                    ];
                    $agotado = true;

                    //hacer un inner join para actualizar
                }
               
            }
            
            if($agotado){

                //inner join para tomar la informacion actualizada ya con los productos eliminados donde su stock fue cero 

                $informacionCarritoActulizada = DB::table('productos')
                ->join('carritoCompras', 'productos.idProducto', '=', 'carritoCompras.idProducto')
                ->where('carritoCompras.idUsuario', '=', $idUsuario)
                ->select('carritoCompras.idCarritoCompra', 'productos.idProducto','productos.nombreProducto','carritoCompras.cantidadCarrito', 'productos.precioProducto', 'productos.stockProducto')
                ->get();


                return view("carritoCompras", ['tamanoCarrito' => $tamanoCarrito, 'informacionCarrito' => $informacionCarritoActulizada,'productosAgotados' =>$productosAgotados]);
            }else{

                return view("carritoCompras", ['tamanoCarrito' => $tamanoCarrito, 'informacionCarrito' => $informacionCarrito]);

            }


        }
        return view("carritoCompras");

    }
    public function store(Request $request)
    {


        $idP = $request->idProducto;
        $idUsuario = Auth::user()->idUsuario;

        $verificacion = false;

        $carritos = carritoCompra::where('idUsuario', $idUsuario)->get();

        $idProducto = intval($idP);//parseo a entero

        //producto sin stock hacer validacion si el stock es cero
        //consulta donde verifique si el stock es igual a cero  
        
        // SELECT * FROM productos WHERE stockProducto =0 AND idProducto = 1;

      


        if( is_numeric($idProducto) && ($idProducto > 0)){



            $comprobacion = Producto::where('stockProducto',0)
            ->where('idProducto',$idProducto)
            ->exists();
            

            if(!$comprobacion){//metodo exitsts devuelve true si encuentra un registro y false si no .

                 // No hay productos con stock cero y el ID dado

                if ($carritos->isEmpty()) {

                    $this->insertarCarrito($request);
    
                }else {
            
    
                    foreach ($carritos as $carrito) {
    
                        if ($idProducto == $carrito->idProducto) { //2 [1,3,3,3]  // 2 [1,3,2,3,2]
    
                            $verificacion = true;
    
                        }
    
                    }
    
                    if ($verificacion) {
                        
    
                        //arreglar poner verificacion
                        $this->actualizarCantidadCarrito($request, $idUsuario, $idProducto,true);
    
                    } else {
    
                        $this->insertarCarrito($request);
    
                    }
                }
            }

        }

        return back();
    }

    public function actualizarCantidadCarrito(Request $request, $idUsuario, $idProducto,$decision)
    {

        // SELECT carritocompras.idCarritoCompra, carritocompras.idProducto, carritocompras.idUsuario , carritocompras.cantidadCarrito, productos.stockProducto FROM productos
        // INNER JOIN carritocompras ON productos.idProducto = carritocompras.idProducto WHERE carritocompras.idUsuario =1 and productos.idProducto=2;

        $carritoEncontrado = DB::table('productos') //encontrar un carrito especificamente con el stock del producto
            ->join('carritocompras', 'productos.idProducto', '=', 'carritocompras.idProducto')
            ->where('carritocompras.idUsuario', '=', $idUsuario)
            ->where('carritocompras.idProducto', '=', $idProducto)
            ->select('carritocompras.idCarritoCompra', 'carritocompras.idProducto', 'carritocompras.idUsuario', 'carritocompras.cantidadCarrito', 'productos.stockProducto')
            ->first();
        
        $stockProducto = $carritoEncontrado->stockProducto; //12
        $idCarritoEncontrado = $carritoEncontrado->idCarritoCompra;
        
        
        if($decision){
            
            $cantidadCarrito = $carritoEncontrado->cantidadCarrito + 1; //8 , //se le suma 1 para actualizar la cantidad
            
        }else{
            $cantidadCarrito = $request->cantidad;//cantidad para ajax 
        }


        if ($cantidadCarrito <= $stockProducto) {

            DB::table('carritocompras') //utilizar la consulta del inner join ya realizada
                ->where('idCarritoCompra', $idCarritoEncontrado)
                ->update(['cantidadCarrito' => $cantidadCarrito]); //se actualiza la cantidad

        } else {
            //no se actualiza la cantidad y se manda un mensaje producto fuera de stock 

            if($decision){
                return back()->with('estado', 'producto fuera de stock');//para la vista index
            }else{
                return $stockProducto;//para ajax
            }
        }

    }

    public function insertarCarrito(Request $request)
    {

        carritoCompra::create([

            "idProducto" => $request->idProducto,
            "idUsuario" => Auth::user()->idUsuario,
            "cantidadCarrito" => 1,
        ]);

    }

    public function eliminarUnCarrito(Request $request, $idCarritoCompra)
    {
        $findCarrito = carritoCompra::findOrfail($idCarritoCompra);
        $findCarrito->delete();
        return back();
    }


    public function actualizarCarrito(Request $request)
    {
        

        $cantidad = $request->cantidad;
        $idProducto = $request->idProducto;
        $idCarrito = $request->idCarrito;
  

        if($cantidad!=null && $idProducto!=null && $idCarrito!=null){

            $verificacion = $this->verificarCantidad($request,$cantidad);

            if($verificacion){

                $idUsuario = Auth::user()->idUsuario;
                $stockDisponible =  $this->actualizarCantidadCarrito($request, $idUsuario, $idProducto,false);

                return response()->json(['stock  disponible' => $stockDisponible]);

            }
        }  
        
        // si la cantidad es menor a cero , contiene letras o otra cosa elimina el carrito . 
        $this->eliminarUncarrito($request,$idCarrito);
        return response()->json([""]);

    }

    public function verificarCantidad($request, $cantidad){

        $verificacion = false;

        if (!(preg_match('/[^0-9]/', $cantidad)) ) {// 1 a2b4ca, 0 123123 

            $numero = intval($cantidad);//convertir a entero 

            if ($numero > 0 && is_numeric($numero)) {
               
                $verificacion = true;
            }

            
        }
        return $verificacion;

    } 
}

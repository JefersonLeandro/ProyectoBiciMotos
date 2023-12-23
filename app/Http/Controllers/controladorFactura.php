<?php

namespace App\Http\Controllers;

use App\Models\carritoCompra;
use App\Models\detallesFactura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Factura;
class controladorFactura extends Controller

{
     
    // $idFacturaRecuperado = 0; 
    // protected $idUsuario = Auth::user()->idUsuario;
    public function index(){

      
        $idUsuario = Auth::user()->idUsuario;
        // SELECT carritocompras.idCarritoCompra , productos.idProducto, carritocompras.cantidadCarrito, productos.precioProducto FROM productos
        //  INNER JOIN carritocompras ON productos.idProducto = carritocompras.idProducto WHERE carritocompras.idUsuario=2;

       

        $informacionCarritos = DB::table('productos')
        ->join('carritoCompras', 'productos.idProducto', '=', 'carritoCompras.idProducto')
        ->where('carritoCompras.idUsuario', '=', $idUsuario)
        ->select('carritoCompras.idCarritoCompra', 'productos.idProducto','productos.nombreProducto','carritoCompras.cantidadCarrito', 'productos.precioProducto','productos.stockProducto')
        ->get();

        // return $informacionCarritos;
        //foreach para sacar el total , iva y total final

        $mostrar = false;
        // return $informacionCarritos->toArray();
        if(!$informacionCarritos->isEmpty()){

            // return "dentre";
          
            $totalbase = 0;

            foreach($informacionCarritos as $unCarrito){

                $cantidadCarrito = $unCarrito->cantidadCarrito;
                $precioProducto = $unCarrito->precioProducto;
    
                $subtotal = $cantidadCarrito*$precioProducto;
    
                $totalbase += $subtotal; 
    
            }
    
            $iva = $totalbase * 0.19;
            $totalFinal = $iva + $totalbase;
            $fechaActual = date("y-m-d");
    
            //generar la factura 
            $insertarFactura = Factura::create([
    
                "fechaFactura"=>$fechaActual,
                "totalFactura"=>$totalFinal,
                "idUsuario"=>$idUsuario,
            ]);
    
            $idFacturaRecuperado = $insertarFactura->id;
        
            //listar todos los carritos
    
            $todosLosCarritos = carritoCompra::get();
    
            // return $todosLosCarritos;
            //generar los datelles con el id recuperado
            //forech para insertar detalles 
            foreach ($informacionCarritos as $unCarrito) {
                
                $cantidadDetalle = $unCarrito->cantidadCarrito;
                $precioProducto = $unCarrito->precioProducto;
                $subtotalIndividual = $precioProducto * $cantidadDetalle;
                $idProducto = $unCarrito->idProducto;
             
    
                $insertarFactura = detallesFactura::create([
    
                    "subtotalDetalle"=>$subtotalIndividual,
                    "cantidadDetalle"=>$cantidadDetalle,
                    "idProducto"=>$idProducto,
                    "idFactura"=>$idFacturaRecuperado,
                ]);
    
                //Restarle la cantidad compranda al stock en linea de cada producto
                $stockProducto = $unCarrito->stockProducto;
                $stockActulizado = $stockProducto - $cantidadDetalle; 
    
                DB::table('productos') //utilizar la consulta del inner join ya realizada 
                ->where('idProducto', $idProducto)
                ->update(['stockProducto'=> $stockActulizado]);
               
                foreach($todosLosCarritos as $elCarrito){
                    
                    $idCarritoC = $elCarrito->idCarritoCompra;
                    $idProductoC = $elCarrito->idProducto;
                    $cantidadC = $elCarrito->cantidadCarrito;
                    $idUsuarioC = $elCarrito->idUsuario;
    
                    if($idProducto == $idProductoC && $stockActulizado < $cantidadC ){
                        //actulizar la cantidad ya que la cantidad supera el stock  
                       
                        $carritoEncontrado = carritoCompra::findOrfail($idCarritoC);
                        $carritoEncontrado->update(['cantidadCarrito'=> $stockActulizado]); 
                    }
                }
                
            }
    
            //eliminar los carritos ya comprados de ese usuario , mirar en amazon este delete si hace de manera general porque se podria hacer con solos lo que se compran aunque ahi se compran todos
            DB::table('carritocompras') //utilizar la consulta del inner join ya realizada
            ->where('idUsuario', $idUsuario)
            ->delete();
            // $productosComprados[] = [
            //     'nombreProducto' => $carrito->nombreProducto,
            //     'precioProducto' => $carrito->precioProducto
            // ]; si los eliminan entonces crearse un metodo que recibas los datos y que lo que haga es retornarlos y preguntar en la otra vista si tiene un valor o no y si lo tiene mandar una url y otra 
    
            // return "iva : ".$iva." totalBase : ".$totalbase." total final : ".$totalFinal." idGenerado : ".$idFacturaRecuperado;
            
            // SELECT productos.idProducto, detallesfacturas.idDetalle, facturas.idFactura, productos.nombreProducto,
            //  productos.precioProducto , detallesfacturas.cantidadDetalle, detallesfacturas.subTotalDetalle , facturas.totalFactura 
            //  FROM productos 
            //  INNER JOIN detallesfacturas ON productos.idProducto = detallesfacturas.idProducto 
            //  INNER JOIN facturas ON detallesfacturas.idFactura = facturas.idFactura 
            //  WHERE facturas.idUsuario=? y where detallesFacturas.idFactura = ?;
        
         }else{
            //como parsarle el idFactura recuperado a la funcion pero el mantega el valor que se le cambio
            // buscar el ultimo de id de esa factura de  ese usuario registrado

            // $factura = factura::get()->where("idUsuario",'=',$idUsuario);
            return "datos vacios";
        }
        
        
        
        
        $informacionFactura = DB::table('productos')
        ->join('detallesFacturas', 'productos.idProducto', '=', 'detallesFacturas.idProducto')
        ->join('facturas', 'detallesFacturas.idFactura', '=', 'facturas.idFactura')
        ->where('facturas.idUsuario', '=', $idUsuario)
        ->where('detallesFacturas.idFactura', '=', $idFacturaRecuperado)
        ->select('productos.idProducto','detallesFacturas.idDetalle','facturas.idFactura','productos.nombreProducto','productos.precioProducto','detallesFacturas.cantidadDetalle','detallesFacturas.subtotalDetalle','facturas.totalFactura')
        ->get();

        $fecha = date("d-m-y");
        // dd($idFacturaRecuperado);
        // dd($informacionFactura);

        return view("factura" ,["informacionFactura"=>$informacionFactura],['fechaActual'=>$fecha]);

    }
}

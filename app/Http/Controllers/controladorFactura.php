<?php

namespace App\Http\Controllers;

use App\Models\carritoCompra;
use App\Models\detallesFactura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Models\Factura;
class controladorFactura extends Controller

{
     

    public function index(){

      
        $idUsuario = Auth::user()->idUsuario;
        // SELECT carritocompras.idCarritoCompra , productos.idProducto, carritocompras.cantidadCarrito, productos.precioProducto FROM productos
        //  INNER JOIN carritocompras ON productos.idProducto = carritocompras.idProducto WHERE carritocompras.idUsuario=2;

        $informacionCarritos = DB::table('productos')
        ->join('carritoCompras', 'productos.idProducto', '=', 'carritoCompras.idProducto')
        ->where('carritoCompras.idUsuario', '=', $idUsuario)
        ->select('carritoCompras.idCarritoCompra', 'productos.idProducto','productos.nombreProducto','carritoCompras.cantidadCarrito', 'productos.precioProducto','productos.stockProducto')
        ->get();

  

        if(!$informacionCarritos->isEmpty()){
          
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
            Session::put('idFacturaRecuperado', $idFacturaRecuperado);

            //listar todos los carritos
    
            $todosLosCarritos = carritoCompra::get();
    
            
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
    
            //eliminar los carritos ya comprados de ese usuario 
            DB::table('carritocompras') //utilizar la consulta del inner join ya realizada
            ->where('idUsuario', $idUsuario)
            ->delete();

            return $this->datosFactura($idUsuario,$idFacturaRecuperado);
        
         }else{
        
            $idFacturaRecuperado = Session::get('idFacturaRecuperado', 0);
            return $this->datosFactura($idUsuario,$idFacturaRecuperado);

        }
        
        
       

    }


    public function datosFactura($idUsuario, $idFacturaRecuperado){

        // SELECT productos.idProducto, detallesfacturas.idDetalle, facturas.idFactura, productos.nombreProducto,
            //  productos.precioProducto , detallesfacturas.cantidadDetalle, detallesfacturas.subTotalDetalle , facturas.totalFactura 
            //  FROM productos 
            //  INNER JOIN detallesfacturas ON productos.idProducto = detallesfacturas.idProducto 
            //  INNER JOIN facturas ON detallesfacturas.idFactura = facturas.idFactura 
            //  WHERE facturas.idUsuario=? y where detallesFacturas.idFactura = ?;
        
        $informacionFactura = DB::table('productos')
        ->join('detallesFacturas', 'productos.idProducto', '=', 'detallesFacturas.idProducto')
        ->join('facturas', 'detallesFacturas.idFactura', '=', 'facturas.idFactura')
        ->where('facturas.idUsuario', '=', $idUsuario)
        ->where('detallesFacturas.idFactura', '=', $idFacturaRecuperado)
        ->select('productos.idProducto','detallesFacturas.idDetalle','facturas.idFactura','productos.nombreProducto','productos.precioProducto','detallesFacturas.cantidadDetalle','detallesFacturas.subtotalDetalle','facturas.totalFactura')
        ->get();

    

        return view("factura" ,["informacionFactura"=>$informacionFactura]);


    }
}

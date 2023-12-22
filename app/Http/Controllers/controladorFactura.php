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
    public function index(){


       //listar los carritos y insertarlos en la tabla detalles y generar una sola factura  y recuperar el id de la factura

        //-actualizar todas las cantidades de los usuarios donde las cantidades de los productos fueron compradas 
        //o generaron la factura llegandole a restar el stock el linea de cada producto sobre el que fue comprado
        //-generar un subtotal para ese usuario con sus cantidades y precios , \ usar el que ya esta. 
        //listar todos los carritos de un usuario y insertarlos en la tabla detalles para la factura 
        //y traer el id de esa factura para relacionarlos a cada detalle y eliminar esos carritos que ya fueron comprados 
        // hacer si tanto complique,en la parte de indexar si no hay ningun producto en carrito y ademas mirar si no tiene ningun detalle 
        // , no hacer nada pero si tiene un detalle y el usuario tiene carrito vacio fue por que compro y de ser asi mostrarlos 
        // una sola vez en la vista carrito con un array y ya porque tambien o sino solo elimimarlos y ya y verificar en amazon como hacen si los eliminan o los dejan.
        

        // SELECT carritocompras.idCarritoCompra , productos.idProducto, carritocompras.cantidadCarrito, productos.precioProducto FROM productos
        //  INNER JOIN carritocompras ON productos.idProducto = carritocompras.idProducto WHERE carritocompras.idUsuario=2;

        $idUsuario = Auth::user()->idUsuario;

        $informacionCarritos = DB::table('productos')
        ->join('carritoCompras', 'productos.idProducto', '=', 'carritoCompras.idProducto')
        ->where('carritoCompras.idUsuario', '=', $idUsuario)
        ->select('carritoCompras.idCarritoCompra', 'productos.idProducto','productos.nombreProducto','carritoCompras.cantidadCarrito', 'productos.precioProducto','productos.stockProducto')
        ->get();

        // return $informacionCarritos;
        //foreach para sacar el total , iva y total final
        
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
       

        //actualizar las cantidades de cada usuario;
        
        // return "iva : ".$iva." totalBase : ".$totalbase." total final : ".$totalFinal." idGenerado : ".$idFacturaRecuperado;
        

        return view("factura");

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class controladorFactura extends Controller
{
    public function index(){

        //terminar de darle estilos a la pagina 
        //-actualizar todas las cantidades de los usuarios donde las cantidades de los productos fueron compradas 
        //o generaron la factura llegandole a restar el stock el linea de cada producto sobre el que fue comprado
        //-generar un subtotal para ese usuario con sus cantidades y precios , \ usar el que ya esta. 
        //listar todos los carritos de un usuario y insertarlos en la tabla detalles para la factura 
        //y traer el id de esa factura para relacionarlos a cada detalle y eliminar esos carritos que ya fueron comprados 
        // hacer si tanto complique,en la parte de indexar si no hay ningun producto en carrito y ademas mirar si no tiene ningun detalle 
        // , no hacer nada pero si tiene un detalle y el usuario tiene carrito vacio fue por que compro y de ser asi mostrarlos 
        // una sola vez en la vista carrito con un array y ya porque tambien o sino solo elimimarlos y ya y verificar en amazon como hacen si los eliminan o los dejan.
        


        return view("factura");

    }
}

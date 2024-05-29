<?php

namespace App\Http\Controllers\tablas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\detallesFactura; 
use App\Models\Factura; 

class controladorTablaDetallesFactura extends Controller
{
    public function index(){

        $detallesFacturas = detallesFactura::get();

        return view("tablas.tablaDetallesFactura", ['detallesFactura'=>$detallesFacturas]);

    }
    public function buscar(Request $request){

        return "TABLA detalles ".$request; 
    }
}

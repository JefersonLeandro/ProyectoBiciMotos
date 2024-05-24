<?php

namespace App\Http\Controllers\tablas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\detallesFactura; 

class controladorTablaDetallesFactura extends Controller
{
    public function index(){

        
        $detalles = detallesFactura::get();

        foreach ($detalles as $detalle) {
            
            $detallef = $detalle->fechaFactura; 
            echo "detalles fecha : ".$detallef;

        }
        

        return view("tablas.tablaDetallesFactura");

    }
}

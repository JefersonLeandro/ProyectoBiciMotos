<?php

namespace App\Http\Controllers\tablas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class controladorTablaDetallesFactura extends Controller
{
    public function index(){


        

        return view("tablas.tablaDetallesFactura");

    }
}

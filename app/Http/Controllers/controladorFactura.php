<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class controladorFactura extends Controller
{
    public function index(){

        return view("factura");

    }
}

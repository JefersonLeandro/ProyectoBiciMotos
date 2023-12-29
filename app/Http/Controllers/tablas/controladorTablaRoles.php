<?php

namespace App\Http\Controllers\tablas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class controladorTablaRoles extends Controller
{
    public function index(){


        

        return view("tablas.tablaRoles");

    }
}

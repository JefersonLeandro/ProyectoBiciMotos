<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Producto;
class controladorProducto extends Controller
{

    public function index(){

        $productos = Producto::get();

        // return $productos->toArray();
        return view('welcome', ['productos' => $productos]);
    
    }
}
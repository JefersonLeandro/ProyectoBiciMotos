<?php

namespace App\Http\Controllers;

use App\Models\carritoCompra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class controladorCarrito extends Controller
{
    

    public function store(Request $request){

        //insertar
        //null,idProducto,idUsuario
      

        carritoCompra::create([

            "idProducto"=> $request->idProducto,
            "idUsuario"=> Auth::user()->idUsuario,

        ]);

        return back();
    }


}

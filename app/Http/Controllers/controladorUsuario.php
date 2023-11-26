<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class controladorUsuario extends Controller
{
    public function store(Request $request){//almacenar los datos del usuario 



        return $request->toArray();



    }
}

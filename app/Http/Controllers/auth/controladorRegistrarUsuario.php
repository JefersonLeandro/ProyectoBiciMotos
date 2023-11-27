<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Models\Usuario;

class controladorRegistrarUsuario extends Controller
{
    public function store(Request $request){//almacenar los datos del usuario 

        
       
        $request->validate([//verificacion de los campos 

            
            "nombreUsuario"=>['required', 'string', 'max:60'],
            "apellidoUsuario"=>['required', 'string', 'max:60'],
            "identificacionUsuario"=>['required', 'string', 'max:12'],
            "emailUsuario"=>['required', 'string', 'email' , 'max:255' , 'unique:Usuarios'],
            "passwordUsuario"=>['required', 'string', 'confirmed:passwordUsuario_confirmation','max:255',Rules\Password::defaults()] 

        ]);

        
        $usuario = Usuario::create([

            "nombreUsuario" =>$request->nombreUsuario,
            "apellidoUsuario" => $request->input("apellidoUsuario"),
            "identificacionUsuario" => $request->input("identificacionUsuario"),
            "passwordUsuario" => bcrypt($request->passwordUsuario),
            "idRol" => $request->input("idRol"),
            
        ]);

        





    }
}

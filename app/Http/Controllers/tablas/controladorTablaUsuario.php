<?php

namespace App\Http\Controllers\tablas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Roles;
use App\Models\Usuario;

class controladorTablaUsuario extends Controller
{
    public function index(){


        $usuarios = Usuario::get();
        $roles = roles::get();
     
        return view("tablaUsuarios",['usuarios'=> $usuarios, 'roles'=>$roles]);


    }

    public function opciones(Request $request){

        $accion = $request->fAccion;
        $idUsuario = $request->idUsuario;

        switch ($accion) {
            case 'insertar':
                $this->insertar($request);
                break;

            case 'modificar':
                $this->modificar($request,$idUsuario);
               
                break;

            case 'eliminar':
                $this->eliminar($request,$idUsuario);
                break; 
        }


        return back();
    }

    public function insertar(Request $request){

        
        $password = bcrypt($request->password);


        Usuario::create([

            "nombreUsuario"=>$request->nombreUsuario,
            "apellidoUsuario"=>$request->apellidoUsuario,
            "identificacionUsuario"=>$request->identificacionUsuario,
            "email"=>$request->email,
            "password"=>$password,
            "idRol"=>$request->idRol,
        ]);

    }
    public function modificar(Request $request,$idUsuario){



        $findUsuario = Usuario::findOrFail($idUsuario); 

        $findUsuario->update([

            "nombreUsuario"=>$request->nombreUsuario,
            "apellidoUsuario"=>$request->apellidoUsuario,
            "identificacionUsuario"=>$request->identificacionUsuario,
            "idRol"=>$request->idRol,
        ]);
        
    }
    public function eliminar(Request $request,$idUsuario){
    
        $findUsuario = Usuario::findOrFail($idUsuario);
        $findUsuario->delete();

    }
}

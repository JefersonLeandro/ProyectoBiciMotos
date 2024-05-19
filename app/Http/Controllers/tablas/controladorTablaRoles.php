<?php

namespace App\Http\Controllers\tablas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Roles;
use Illuminate\Support\Facades\DB;
class controladorTablaRoles extends Controller
{
    public function index(){

        $roles = Roles::get();
    
        return view("tablas.tablaRoles", ['roles' => $roles]);

    }

    public function opciones(Request $request, $idRol){
        $opcion = $request->fAccion;
    
        switch ($opcion) {
            case 'insertar':
                $this->insertar($request);
                break;

            case 'modificar':
                $this->modificar($request, $idRol);
                break;

            case 'eliminar':
                $this->eliminar($request, $idRol); 
                break;
        }
        
        return back();

    }

    public function insertar($request){

        Roles::create([
            'nombreRol'=>$request->fNombreRol
        ]);
    }

    public function modificar($request, $idRol){

        $nombreRol = $request->fNombreRol;

        $rolBD = Roles::findOrFail($idRol);
        $rolBD->nombreRol = $nombreRol;
        $rolBD->save();
    
    }
    
    public function eliminar($request, $idRol){
        $rolBD = Roles::findOrFail($idRol);
        $rolBD->delete(); 
    }
}

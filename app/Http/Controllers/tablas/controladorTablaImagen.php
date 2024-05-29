<?php

namespace App\Http\Controllers\tablas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Imagen;
use App\Models\Producto;

class controladorTablaImagen extends Controller
{
    public function index(){
 

        $imagenes = imagen::get();

        return view("tablas.tablaImagen",["imagenes"=>$imagenes]);

    }

    public function opciones(Request $request){

        $accion = $request->fAccion;

        $idImagen = $request->idImagen;
        $resultadoBuscar = 0;

        switch ($accion) {

            case 'insertar':
                $this->insertar($request);
                break;

            case 'modificar':
                $this->modificar($request,$idImagen);
               
                break;

            case 'eliminar':
                $this->eliminar($request,$idImagen);
                break; 

            case 'buscar':
            $resultadoBuscar =  $this->buscarProducto($request);
              break; 
        }

        if($accion=="buscar"){

            return $resultadoBuscar;
        }

        return back();
    }



    public function insertar(Request $request){

        imagen::create([

            "nombreImagen"=>$request->nombreImagen,
            "tipoImagen"=>$request->tipoImagen,
            "idProducto"=>$request->idProducto,
        ]);
    }


    public function modificar(Request $request, $idImagen){

        $findImagen = imagen::findOrfail($idImagen);
        $findImagen->update([

            "nombreImagen"=>$request->nombreImagen,
            "tipoImagen"=>$request->tipoImagen,
            "idProducto"=>$request->idProducto,
        ]);


    }


    public function eliminar(Request $request,$idImagen){

        $findImagen = imagen::findOrfail($idImagen);
        $findImagen->delete();
    }




    public function buscarProducto(Request $request){
      
        $valor = $request->valor;
        $imagenes = imagen::get();
        
     
        $productosEncontrados = Producto::where('nombreProducto', 'like', '%'.$valor.'%')
        ->orWhere('descripcionProducto','like','%'.$valor.'%')
        ->get();
        
        
        if(!($productosEncontrados)->isEmpty()){
            
            return view("tablas.tablaImagen" ,['productosEncontrados'=>$productosEncontrados , 'valor'=>$valor ,"imagenes"=>$imagenes] );
        }
        
        
        $productosEncontrados[] = [
            'nombreProducto' => 'nose encontraron concidencias'
        ];

        return view("tablas.tablaImagen" ,['productosEncontrados'=>$productosEncontrados , 'valor'=>$valor ,"imagenes"=>$imagenes]); 

    }
    public function buscar(Request $request){

        return "TABLA Imagenes ".$request; 
    }

}

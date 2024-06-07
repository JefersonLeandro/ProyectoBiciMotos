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

        $opcion = $request->fOpcion;
        $valor = $request->fBuscar;
        $informacion;

        switch ($opcion) {
            case 'Id-producto':
                $informacion = $this->buscarProductoId($valor);
                break;
       
            case 'Nombre-producto':
                return $informacion = $this->busquedaEspecifica('nombreProducto',$valor);
                break;
       
            case 'Nombre-imagen':
                $informacion = $this->busquedaEspecifica('nombreImagen',$valor);
                break;
            case 'Tipo-imagen':
                $informacion = $this->busquedaEspecifica('tipoImagen',$valor);
                break;
            
            default:
                return back(); 
                break;
        }
        return view("tablas.tablaImagen",[
                    'imagenes'=>$informacion, 
                    'valor'=>$valor,
                    'columna'=>$opcion]); 
    }

    public function buscarProductoId($valor){
        return $imagenes = Imagen::where("idProducto",'=' , $valor)->get(); 
    }

    public function busquedaEspecifica($columna, $valor){
        
        $imagenes = Imagen::where($columna, 'like', '%' . $valor . '%')
        ->with('producto')
        ->get();

        return $imagenes; 
    }

}

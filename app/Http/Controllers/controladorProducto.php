<?php

namespace App\Http\Controllers;


use App\Models\carritoCompra;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Imagen;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class controladorProducto extends Controller
{
    
    public function index(){

        $productos = DB::table('productos')
                ->join('imagenes', 'productos.idProducto', '=', 'imagenes.idProducto')
                ->where('tipoImagen', '=',0 )
                ->select('imagenes.nombreImagen', 'productos.idProducto','productos.nombreProducto','productos.descripcionProducto', 'productos.precioProducto', 'productos.stockProducto')
                ->get();

        if(Auth::user()){

            $numeroCarritos = $this->obtenerTamanoCarrito();
            
            return view('index', ['productos' => $productos ,'tamanoCarrito'=>$numeroCarritos]);
        }
       
        return view('index', ['productos' => $productos]);
    
    }


    public function indexTablaProducto(){
        
        $productos = Producto::get();
        return view('tablas.tablaProducto',['productos'=>$productos]);
    }


    public function obtenerTamanoCarrito(){

        $idUsuario = Auth::user()->idUsuario;
        $tamanoCarrito = carritoCompra::where('idUsuario', $idUsuario)->count();
        return $tamanoCarrito;
    }
    public function opciones(Request $request){
        
        $accion = $request->fAccion;
        $idProducto = $request->idProducto; 
        
        switch ($accion) {

            case 'insertar':
                $this->insertar($request); 
                break;
            case 'modificar':
                $this->modificar($idProducto, $request);
                break;
            case 'eliminar':
                $this->eliminar($idProducto, $request);
                break;
        }

        return back(); 

    }

    public function insertar($request){
        Producto::create([
            "nombreProducto"=>$request->fNombreProducto,
            "descripcionProducto"=>$request->fDescripcionProducto,
            "precioProducto"=>$request->fPrecioProducto,
            "stockProducto"=>$request->fStockProducto 
        ]);   
    }

    public function modificar($idProducto, $request){
        
        $productoBd = Producto::findOrFail($idProducto);
        
        $productoBd->update([
            "nombreProducto"=>$request->fNombreProducto,
            "descripcionProducto"=>$request->fDescripcionProducto,
            "precioProducto"=>$request->fPrecioProducto,
            "stockProducto"=>$request->fStockProducto
        ]);

    }

    public function eliminar($idProducto, $request){
        
        $productoBd = Producto::findOrFail($idProducto);
        $productoBd->delete();
    }

    public function buscar(Request $request){

        return "TABLA productos ".$request; 
    }

    
}
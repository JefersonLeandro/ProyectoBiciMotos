<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use  Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use PharIo\Manifest\Email;
use App\Models\Usuario;


class controladorAutenticarUsuario extends Controller
{
  

    public function store(Request $request){

        // Validación de credenciales
        $credenciales = $request->validate([
            "emailUsuario" => ['required', 'string', 'email', 'max:255'],//reglas de validacion
            "passwordUsuario" => ['required', 'max:255', 'string'],
        ]);
    
        // Intento de autenticación
        if (!Auth::attempt(['emailUsuario' => $credenciales['emailUsuario'], 'password'=> $credenciales['passwordUsuario']])) {

            // Credenciales incorrectas
            throw ValidationException::withMessages([
                "emailUsuario" => __("auth.failed")
            ]);
        }
    
        // Credenciales correctas
        $request->session()->regenerate();//regenerar el token o el identificador de la session osea cambia el antiguo por uno nuevo 
    
        return redirect()->intended()->with('estado', '¡Bienvenido, has iniciado sesión!');// el metodo intended redirecciona a la raiz o osea al home 
    }
    

}

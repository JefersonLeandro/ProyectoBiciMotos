<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class controladorAutenticarUsuario extends Controller
{
    public function store(Request $request){

        // return $request->toArray();

          // Validación de credenciales
          $credentials = $request->validate([
            "email" => ['required','string', 'email', 'max:255'],//reglas de validacion
            "password" => ['required','max:255', 'string'],
        ]);
        // $credentials =$request([]);
       

        // Intento de autenticación
        if (!Auth::attempt($credentials)) {

            // Credenciales incorrectas
            throw ValidationException::withMessages([
                "email" => __("auth.failed")
            ]);
        }
        
        // return back();
        // Credenciales correctas
        $request->session()->regenerate();//regenerar el token o el identificador de la session osea cambia el antiguo por uno nuevo 
    
        return redirect()->intended()->with('estado', '¡Bienvenido, has iniciado sesión!');//

    }

}

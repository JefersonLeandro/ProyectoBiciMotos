<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
// use Illuminate\Auth\Authenticatable;

class Usuario extends Authenticatable  {

    use HasFactory;
    
    protected $table ='usuarios';// personalizar la tabla y ademas para que la clase auth la pueda encontrar. 

    protected $fillable = [
        'nombreUsuario',
        'apellidoUsuario',
        'identificacionUsuario',
        'emailUsuario',
        'passwordUsuario',
        'idRol',
    ];

    protected $hidden = [
        'passwordUsuario',
        'remember_token',
    ];


    public function getAuthPassword()//para que apunte al passwordUsuario en vez de password 
    {
        return $this->passwordUsuario;
    }


}

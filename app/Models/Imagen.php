<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    use HasFactory;


    protected $table = "imagenes"; 
    protected $primaryKey = "idImagen"; 

    protected $fillable = [
       'nombreImagen',
       'tipoImagen',
       'idProducto',
   ];
   public $timestamps = false;
}

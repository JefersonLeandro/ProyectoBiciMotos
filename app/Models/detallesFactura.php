<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detallesFactura extends Model
{
    use HasFactory;

     // protected $primaryKey  =''; 
     protected $table  ='detallesFacturas'; 
     protected $fillable = [
        'subtotalDetalle',
        'cantidadDetalle',
        'idProducto',
        'idFactura',
    ];

    public $timestamps = false;
}

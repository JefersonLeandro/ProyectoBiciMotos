<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Factura extends Model
{
    use HasFactory;

    // protected $primaryKey  ='idFactura'; 
     protected $fillable = [
        'fechaFactura',
        'totalFactura',
        'idUsuario',
    ];

    public $timestamps = false;


}

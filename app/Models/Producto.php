<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\detallesFactura; 

class Producto extends Model
{
    use HasFactory;

    protected $primaryKey = 'idProducto';

    protected $fillable =[
        'nombreProducto',
        'descripcionProducto',
        'precioProducto',
        'stockProducto'
    ]; 
    
    public $timestamps = false;  

    public function detallesFactura(): HasMany{

        return $this->hasMany(detallesFactura::class, 'idProducto', 'idProducto');
    }


}




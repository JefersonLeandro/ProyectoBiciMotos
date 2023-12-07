<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class carritoCompra extends Model
{
    use HasFactory;

    protected $primaryKey= 'idCarritoCompra';
    protected $table = 'carritoCompras';//por defecto laravel busca bds con el nombre carrito_compras en minuscula para no cambiar todo solo se le define el nombre de la bd
    protected $fillable=[
        "idProducto",
        "idUsuario",
        "cantidadCarrito",
    ];
}

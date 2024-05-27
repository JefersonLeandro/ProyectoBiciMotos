<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Factura; 
use App\Models\Producto; 
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    /**
     * Get the user that owns the detallesFactura
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    
    public function factura(): BelongsTo{
        return $this->belongsTo(Factura::class, 'idFactura');
    }

    #los metodos para belongsTo se deben asignar en sigular 
    
    #1.modelo de relacion.  
    #2.llave foranea para unida al otro modelo relacionado. 

    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class, 'idProducto');
    }
    
    

}

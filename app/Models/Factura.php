<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\detallesFactura; 
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Factura extends Model
{
    use HasFactory;


    protected $primaryKey  ='idFactura'; 
     protected $fillable = [
        'fechaFactura',
        'totalFactura',
        'idUsuario',
    ];

    public $timestamps = false;

    /**
     * Get the user that owns the Factura
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    
    public function usuario(): BelongsTo {
        return $this->belongsTo(Usuario::class, 'idUsuario');
    }

    
    #hasMany - metodos en plural
    public function detalles(): HasMany{   

        #1. argumento -> modelo de muchos 
        #2. argumento -> llave foranea (fk) 
        #3. argumento -> llave primaria (pk) del modelo padre en el que no encontramos osea este caso Factura 

        return $this->hasMany(detallesFactura::class, 'idFactura', 'idFactura');
    }
   
}

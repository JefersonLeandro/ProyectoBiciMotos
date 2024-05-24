<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Factura; 
use Illuminate\Database\Eloquent\Relations\BelongsTo;


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

     /**
     * Get the user that owns the Factura
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    
    public function usuario(): BelongsTo {
        return $this->belongsTo(Usuario::class, 'idUsuario');
    }
    
    public function detallesFactura(): HasMany {
        return $this->hasMany(detallesFacturas::class, 'idFactura', 'idDetalle');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Usuarios;

class roles extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'idRol';

    protected $fillable=[ 
        'nombreRol'
    ];


    public $timestamps = false;

  
    public function Usuarios(): HasMany{
        return $this->hasMany(Usuarios::class, 'idRol', 'idUsuario');
    }

}

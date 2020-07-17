<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $table = 'vehiculos';
    protected $fillable = [
        'placa', 'marca', 'tipo'
    ];

    public function Propietario()
    {
        return $this->belongsTo(Propietario::class);
    }
}

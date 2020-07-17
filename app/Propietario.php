<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Propietario extends Model
{
    protected $table = 'propietarios';
    protected $fillable = [
        'nombre', 'cedula'
    ];

    public function vehiculos()
    {
        return $this->hasMany(Vehiculo::class);
    }
}

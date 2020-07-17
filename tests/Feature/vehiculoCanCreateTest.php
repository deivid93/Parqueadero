<?php

namespace Tests\Feature;

use App\Propietario;
use App\Vehiculo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Tests\TestCase;

class vehiculoCanCreateTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreatePropietario()
    {
        $propietario = new Propietario();
        $propietario->nombre = 'test';
        $propietario->cedula = '241242';
        $propietario->save();
    }

    public function testCreateVehiculo(){
        $vehiculo = new Vehiculo();
        $vehiculo->imagen = 'imagen';
        $vehiculo->placa = 'gerger';
        $vehiculo->marca = 'regerg';
        $vehiculo->tipo = 'C';
        $propietario = Propietario::find(10);
        $vehiculo->Propietario()->associate($propietario);
        $vehiculo->save();
    }
}

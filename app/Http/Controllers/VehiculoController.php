<?php

namespace App\Http\Controllers;

use App\Propietario;
use App\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VehiculoController extends Controller
{
    public function index(Request $request)
    {
        return Vehiculo::all();

    }


    public function store(Request $request)
    {

        $exploded = explode (',', $request->imagen);
        $decoded = base64_decode($exploded[1]);
        if(str_contains($exploded[0], 'jpeg')){
            $extension = 'jpg';
        }else{
            $extension = 'png';
        }

        $filename = Str::random(5) . '.'. $extension;
        $path = public_path() . '/image/' .$filename;
        file_put_contents($path, $decoded);

        if($request->idP != ''){
            $propietario = Propietario::find($request->idP);
        }else{
            $propietario = new Propietario();
            $propietario->nombre = $request->propietario['nombre'];
            $propietario->cedula = $request->propietario['cedula'];
            $propietario->save();
        }

        $vehiculo = new Vehiculo();
        $vehiculo->imagen = $filename;
        $vehiculo->placa = $request->placa;
        $request->marca = ucfirst ( $request->marca );
        $vehiculo->marca = $request->marca;
        $vehiculo->tipo = $request->tipo;

        $vehiculo->Propietario()->associate($propietario);
        $vehiculo->save();

        return $vehiculo;
    }
}

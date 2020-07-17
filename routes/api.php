<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Vehiculo;



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('vehiculos', 'VehiculoController@index' );
Route::get('vehiculos/filter/{filter}', function($filter){
    return Vehiculo::where('marca', $filter)->get();
    return $filter;
});
Route::post('vehiculo/new', 'VehiculoController@store' );
Route::get('propietarios', 'PropietarioController@index' );




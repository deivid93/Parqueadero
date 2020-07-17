<?php

namespace App\Http\Controllers;

use App\Propietario;
use Illuminate\Http\Request;

class PropietarioController extends Controller
{
    public function index(Request $request)
    {

        return Propietario::all();

    }
}

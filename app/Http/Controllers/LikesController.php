<?php

namespace App\Http\Controllers;

use App\Models\Habitacion;
use Illuminate\Http\Request;

class LikesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function update(Request $request, Habitacion $habitacion)
    {
        //
        return auth()->user()->meGusta()->toggle($habitacion);
    }


}

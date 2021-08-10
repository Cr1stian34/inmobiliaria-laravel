<?php

namespace App\Http\Controllers;

use App\Models\CategoriaHabitacion;
use App\Models\Habitacion;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    //
    public function show(CategoriaHabitacion $categoriaHabitacion){
        $habitaciones = Habitacion::where('categoria_id',$categoriaHabitacion->id)->paginate(6);
        return view('categorias.show',compact('habitaciones','categoriaHabitacion'));
    }
}

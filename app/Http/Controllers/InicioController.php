<?php

namespace App\Http\Controllers;

use App\Models\Habitacion;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CategoriaHabitacion;

class InicioController extends Controller
{
    //
    public function index(){
        //Mostrar las habitacioes por cantidad de votos
        //$votadas= Habitacion::has('likes','>',0)->get();
        $votadas= Habitacion::withCount('likes')->orderBy('likes_count','desc')->take(3)->get();
         //Obtener las publicaciones mas nuevas
        $nuevas = Habitacion::latest()->take(5)->get();
        //Obtener todas las categorias
        $categorias= CategoriaHabitacion::all();
        //return $categorias;

        //Agrupar las publicaciones por categoria
        $habitaciones = [];

        foreach($categorias as $categoria){
            $habitaciones[Str::slug($categoria->nombre)][]=Habitacion::where('categoria_id',$categoria->id)->take(3)->get();
        }
       // return $habitaciones;

        return view('inicio.index',compact('nuevas','habitaciones','votadas'));
    }
}

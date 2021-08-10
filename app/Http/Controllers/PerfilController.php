<?php

namespace App\Http\Controllers;

use App\Models\Habitacion;
use App\Models\Perfil;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function show(Perfil $perfil)
    {
        //Obtenner las publicaciones con paguinacion
        $publicaciones = Habitacion::where('user_id', $perfil->user_id)->paginate(6);

        return view('perfiles.show', compact('perfil','publicaciones'));
        //return $perfil;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit(Perfil $perfil)
    {
        $this->authorize('view',$perfil);
        //
        return view('perfiles.edit', compact('perfil'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perfil $perfil)
    {
        //Ejecutar el policy
        $this->authorize('update',$perfil);
        //Validar la entrada de los datos
        $date = request()->validate([
             'nombre' => 'required',
             'biografia' => 'required'
        ]);
        //Si el usuario sube una imagen
        if($request['imagen']){
            $ruta_imagen = $request['imagen']->store('upload-perfiles','public');

            //Resize de la imagen
            $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(600,600);
            $img->save();

            //Crear una arreglo de imagen
            $array_imagen = ['imagen' => $ruta_imagen];
        }
        //Asignar nombre
        auth()->user()->name = $date['nombre'];
        auth()->user()->save();

        //Eliminar nombre de $date 
        unset($date['nombre']);

        //Guardar informacion
        auth()->user()->perfil()->update( array_merge(
            $date,
            $array_imagen ?? []
        ));
        //Redireccionar
        return redirect('habitaciones');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perfil $perfil)
    {
        //
    }
}

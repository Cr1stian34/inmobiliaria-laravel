<?php

namespace App\Http\Controllers;

use App\Models\CategoriaHabitacion;
use App\Models\Habitacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use App\Models\User;

class HabitacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show','search']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Auth::user()->publicaciones->dd();
        $usuario = auth()->user();

        //$publicaciones = auth()->user()->publicaciones;
        //Publicaciones con paguinación
        $publicaciones = Habitacion::where('user_id', $usuario->id)->paginate(4);

       return view('habitaciones.index')
              ->with('publicaciones',$publicaciones)
              ->with('usuario',$usuario);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //DB::table('categoria_habitacion')->get()->pluck('nombre','id')->dd();
        //Obtener las categorias (sin modelo)
        //$categorias = DB::table('categoria_habitacions')->get()->pluck('nombre','id');

        //Con modelo
        $categorias = CategoriaHabitacion::all(['id','nombre']);

        return view('habitaciones.create')->with('categorias',$categorias);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // dd($request['imagen']->store('upload-habitaciones','public'));

       //Validacion de los campos
        $data = request()->validate([
            'titulo' => 'required|min:6',
            'categoria' => 'required',
            'precio' => 'required',
            'ubicacion' => 'required',
            'callep' => 'required',
            'contacto' => 'required',
            'descripcion' => 'required',
            'estado' => 'required',
            'imagen' => 'required|image'
        ]);

        //Obtener la ruta de la imagen
        $ruta_imagen = $request['imagen']->store('upload-habitaciones','public');

        //Resize de la imagen
        $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(1000,550);
        $img->save();

        //Alamacenar en la bases de datos (sin modelo)
      //  DB::table('habitacions')->insert([
        //    'titulo'=>$data['titulo'],
        //    'precio'=>$data['precio'],
        //    'ubicacion'=>$data['ubicacion'],
        //    'contacto'=>$data['contacto'],
        //    'descripcion'=>$data['descripcion'],
        //    'imagen'=> $ruta_imagen,
        //    'user_id'=> Auth::user()->id,
        //    'categoria_id'=>$data['categoria'],
       // ]);

       //Almacenar en la base de datos con modelo
        auth()->user()->publicaciones()->create([
              'titulo'=>$data['titulo'],
              'precio'=>$data['precio'],
              'ubicacion'=>$data['ubicacion'],
              'callep'=>$data['callep'],
              'contacto'=>$data['contacto'],
              'descripcion'=>$data['descripcion'],
              'estado'=>$data['estado'],
              'imagen'=> $ruta_imagen,
              'categoria_id'=>$data['categoria'],
        ]);

        //Redireccionar
        return redirect('habitaciones');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Habitacion  $habitacion
     * @return \Illuminate\Http\Response
     */
    public function show(Habitacion $habitacion)
    {
        //Obtener si el usuario actual le gusta la publicacion y esta autenticado
        $like = (auth()->user()) ? auth()->user()->meGusta->contains($habitacion->id) : false;

        //Pasa la cantidad de likes a la vista
        $likes = $habitacion->likes->count();

        return view('habitaciones.show',compact('habitacion','like','likes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Habitacion  $habitacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Habitacion $habitacion)
    {
        $this->authorize('view', $habitacion); 
        $categorias = CategoriaHabitacion::all(['id','nombre']);

        return view('habitaciones.edit',compact('categorias','habitacion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Habitacion  $habitacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Habitacion $habitacion)
    {   
        //Revisar el policy
        $this->authorize('update', $habitacion);

          //Validacion de los campos
          $data = request()->validate([
            'titulo' => 'required|min:6',
            'categoria' => 'required',
            'precio' => 'required',
            'ubicacion' => 'required',
            'callep' => 'required',
            'contacto' => 'required',
            'descripcion' => 'required',
            'estado' => 'required',
        ]);

        //Asignar los valores
        $habitacion->titulo = $data['titulo'];
        $habitacion->categoria_id = $data['categoria'];
        $habitacion->precio = $data['precio'];
        $habitacion->ubicacion = $data['ubicacion'];
        $habitacion->callep = $data['callep'];
        $habitacion->contacto = $data['contacto'];
        $habitacion->descripcion = $data['descripcion'];
        $habitacion->estado = $data['estado'];

        //Si el usuario sube una nueva imagen
        if(request('imagen')){
            $ruta_imagen = $request['imagen']->store('upload-habitaciones','public');

            //Resize de la imagen
            $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(1000,550);
            $img->save();

            //Asignar al objeto
            $habitacion->imagen = $ruta_imagen;
        }

        $habitacion->save();

        return redirect('habitaciones');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Habitacion  $habitacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Habitacion $habitacion)
    {
        //Ejecutar el policy
        $this->authorize('delete',$habitacion);

        //Elimniar la publicacion
        $habitacion->delete();

        return redirect('habitaciones');
    }

    public function search(Request $request){
        $busqueda = $request->get('buscar');
        $habitaciones = Habitacion::where('titulo','like','%' . $busqueda . '%')->paginate(10);
        $habitaciones->appends(['buscar'=>$busqueda]);
        return view('busquedas.show',compact('habitaciones','busqueda'));
    }
}

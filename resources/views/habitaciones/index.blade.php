@extends('layouts.app')

@section('botones')
    <a href="{{route('habitaciones.create')}}" class="btn btn-outline-primary mr-2 text-uppercase font-weight-bold">
        <svg class="icono" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
          </svg>
        Crear Publicación</a>
    <a href="{{route('perfiles.edit',['perfil' => Auth::user()->id])}}" class="btn btn-outline-primary mr-2 font-weight-bold">
        <svg class="icono" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
          </svg>
        Editar Perfil</a>
    <a href="{{route('perfiles.show',['perfil' => Auth::user()->id])}}" class="btn btn-outline-primary mr-2 font-weight-bold">
        <svg class="icono" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
          </svg>    
    Ver Perfil</a>
@endsection

@section('content')

<h2 class="text-center mb-3">Administra tus Inmuebles</h2>

   <div class="col-md-10 mx-auto bg-white p-3">
       <table class="table table-bordered">
           <thead class="bg-primary text-light">
               <tr>
                   <th scole="col">Titulo</th>
                   <th scole="col">Precio</th>
                   <th scole="col">Ubicación</th>
                   <th scole="col">Contacto</th>
                   <th scole="col">Categoria</th>
                   <th scole="col">Acciones</th>
               </tr>
           </thead>
           <tbody>
               @foreach($publicaciones as $publicacion)
                 <tr>
                    <td>{{$publicacion->titulo}}</td>
                    <td>{{$publicacion->precio}}</td>
                    <td>{{$publicacion->ubicacion}}</td>
                    <td>{{$publicacion->contacto}}</td>
                    <td>{{$publicacion->categoria->nombre}}</td>
                    <td>
                        <eliminar-habitacion 
                             habitacion-id={{$publicacion->id}}
                        ></eliminar-habitacion>
                         <a href="{{route('habitaciones.edit',['habitacion' => $publicacion->id])}}" class="btn btn-dark w-30">Editar</a>
                         <a href="{{route('habitaciones.show',['habitacion' => $publicacion->id])}}" class="btn btn-success w-30">Ver</a>
                    </td>
                 </tr>     
               @endforeach
           </tbody>
       </table>

       <div class="col-12 mt-10 justify-content-center d-flex">
          {{$publicaciones->links()}}  
       </div>

       <h2 class="text-center my-5">Lista de publicaciones con mas votos</h2>
       <div class="col-md-10 mx-auto bg-white p-3">
           @if(count($usuario->meGusta)>0)
           <ul class="list-group">
              @foreach($usuario->meGusta as $habitacion)
                  <li class="list-group-item d-flex justify-content-between aling-items-center">
                      <p>{{$habitacion->titulo}}</p>
                      <a class="btn btn-outline-success text-uppercase font-weight-bold" href="{{route('habitaciones.show',['habitacion'=>$habitacion->id])}}">Ver</a>
                  </li>
              @endforeach

           </ul>
           @else
              <p class="text-center">Aún no tienes publicaciones guardadas 
                  <small>Votal a alguna publicacion y apareceran aqui</small></p>
           @endif
       </div>
      
   </div>

@endsection

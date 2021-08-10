@extends('layouts.app')

@section('botones')
     <a href="{{route('habitaciones.index')}}" class="btn btn-outline-primary mr-2 text-uppercase font-weight-bold">
        <svg class="icono" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
          </svg>
        Volver</a>
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-3">
            @if($perfil->imagen)
                <img src="/storage/{{$perfil->imagen}}" class="w-100 rounded-circle" alt="Imagen Usuario">
            @endif
        </div>
        <div class="col-md-7 mt-5 mt-md-0">
            <h2 class="text-center mb-2 text-primary">{{$perfil->usuario->name}}</h2>
            <div class="biografia">
                {!! $perfil->biografia !!}
            </div>
     </div>
    </div>
</div>

   <h2 class="text-center my-5">Publicaciones creadas por {{$perfil->usuario->name}}</h2>
   <div class="container">
      <div class="row mx-auto bg-white p-4">
          @if(count($publicaciones) > 0)
              @foreach($publicaciones as $publicacion)
                 <div class="col-md-4 mb-4">
                     <div class="card">
                          <img src="/storage/{{$publicacion->imagen}}" class="card-img-top" alt="Imagen publicación">

                          <div class="card-body">
                            <h3>{{$publicacion->titulo}}</h3>
                            <a href="{{route('habitaciones.show', ['habitacion' => $publicacion->id])}}" class="btn btn-primary d-block mt-4 text-uppercase font-weight-bold">Ver Publicación</a>
                          </div>
                     </div>
                 </div>
                  
              @endforeach
          @else
              <p class="text-center w-100">No hay publicaciones aún....</p>
          @endif
         
      </div>
      
      <div class="d-flex justify-content-center">
        {{$publicaciones->links()}}
      </div>
   </div>
  
@endsection
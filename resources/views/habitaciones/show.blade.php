@extends('layouts.app')

@section('botones')
     <a href="{{route('habitaciones.index')}}" class="btn btn-outline-primary mr-2 text-uppercase font-weight-bold">
        <svg class="icono" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
          </svg>
        Volver</a>
@endsection

@section('content')

  <article class="contenido-habitacion" >
      <h1 class="text-center mb-4">{{$habitacion->titulo}}</h1>

      <div class="imagen-habitacion">
        <img src="/storage/{{$habitacion->imagen}}" class="w-100">
    </div>

      <div class="habitacion-meta mt-2">
          <p>
              <span class="font-weight-bolt text-primary">Categoria:</span>
              {{$habitacion->categoria->nombre}}
          </p>

          <p>
              <span class="font-weight-bolt text-primary">Autor:</span>
              {{$habitacion->autor->name}}
          </p>

          <p>
            <span class="font-weight-bolt text-primary">Precio en dolares:</span>
            {{$habitacion->precio}}
          </p>

          <p>
            <span class="font-weight-bolt text-primary">Ubicación:</span>
            {{$habitacion->ubicacion}}
        </p>

        <p>
            <span class="font-weight-bolt text-primary">Calle principal:</span>
            {{$habitacion->callep}}
        </p>

        <p>
            <span class="font-weight-bolt text-primary">Contacto:</span>
            {{$habitacion->contacto}}
        </p>

        <p>
            <span class="font-weight-bolt text-primary">Fecha de publicación:</span>
            @php
                $fecha = $habitacion->categoria->created_at
            @endphp

            <fecha-habitacion fecha="{{$fecha}}"></fecha-habitacion>
        </p>

        <p>
            <span class="font-weight-bolt text-primary">Estado del inmueble:</span>
            {{$habitacion->estado}}
        </p>

        <div class="descripcion">
            <h2 class="my-2 text-primary">Descripción del inmueble</h2>
            {!!$habitacion->descripcion!!}
        </div>

        <div class="justify-content-center row text-center">
            <like-button
            habitacion-id = "{{$habitacion->id}}"
            like="{{$like}}"
            likes="{{$likes}}"
            ></like-button>   
        </div>
   
        

@endsection
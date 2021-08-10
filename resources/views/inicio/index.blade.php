@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('hero')
<div class="hero-categorias">
    <form class="container h-100" action={{route('buscar.show')}}>
         <div class="row h-100 align-items-center">
            <div class="col-md-4 texto-buscar">
               <p class="display-4">Encuentra un inmueble que desees arrendar</p>

               <input type="search"
                      name="buscar"
                      class="form-control"
                      placeholder="Buscar inmueble">
            </div>
         </div>
    </form>

</div>
@endsection

@section('content')
    
    <div class="container nuevas-publicaciones">
        <h2 class="titulo-categoria text-uppercase mt-5 mb-4">Últimas publicaciones</h2>

        <div class="owl-carousel owl-theme">
            @foreach($nuevas as $nueva)
               @if($nueva->estado == "Disponible")
                <div class="card">
                    <img src="/storage/{{$nueva->imagen}}" class="card-img-top" alt="imagen publicacion">

                    <div class="card-body">
                        <h3>{{Str::title($nueva->titulo)}}</h3>
                        <p>{{Str::words(strip_tags($nueva->descripcion),20)}}</p>
                        <a href="{{route('habitaciones.show',['habitacion'=> $nueva->id])}}" class="btn btn-primary d-block font-weight-bold text-uppercase">Ver Publicación</a>
                    </div>
                </div>
                @endif
            @endforeach

        </div>
    </div>

    <div class="container">
        <h2 class="titulo-categoria text-uppercase mt-5 mb-4">Publicaciones más votadas</h2>

        <div class="row">
                 @foreach($votadas as $habitacion)
                   @if($habitacion->estado == "Disponible")
                       @include('ui.habitacion')
                   @endif         
            @endforeach
        </div>
     </div> 

    @foreach($habitaciones as $key => $grupo)
        <div class="container">
           <h2 class="titulo-categoria text-uppercase mt-5 mb-4">{{str_replace('-',' ',$key)}}</h2>

           <div class="row">
               @foreach($grupo as $habitaciones)
                    @foreach($habitaciones as $habitacion)
                      @if($habitacion->estado == "Disponible")
                          @include('ui.habitacion')
                      @endif
                    @endforeach
                   
               @endforeach
           </div>
        </div> 
    @endforeach
@endsection
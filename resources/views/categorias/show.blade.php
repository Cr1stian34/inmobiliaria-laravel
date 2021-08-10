@extends('layouts.app')
    
@section('content')

    <div class="container">
        <h2 class="titulo-categoria text-uppercase mt-5 mb-4">
            Categoria: {{$categoriaHabitacion->nombre}}
        </h2>

        <div class="row">
            @foreach($habitaciones as $habitacion)
                @include('ui.habitacion')
            @endforeach
        </div>

        <div class="col-12 mt-10 justify-content-center d-flex">
            {{$habitaciones->links()}}
        </div>
    </div>

@endsection
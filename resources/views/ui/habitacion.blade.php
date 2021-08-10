<div class="col-md-4 mt-4">
    <div class="card shadow">
        <img class="card-img-top" src="/storage/{{$habitacion->imagen}}" alt="imagen publicacion">
        <div class="card-body">
            <h3 class="card-title">{{$habitacion->titulo}}</h3>

            <div class="meta-habitacion d-flex justify-content-between">
                  @php
                      $fecha = $habitacion->created_at
                  @endphp

                  <p class="text-primary fecha font-weight-bold">
                     <fecha-habitacion fecha="{{$fecha}}"></fecha-habitacion>
                  </p>

                  <p>{{count($habitacion->likes)}} votos favorables</p>
                 
            </div>
            <div class="meta-habitacion d-flex justify-content-between">

                <p>Precio: {{$habitacion->precio}}$</p>
                <p>Ubicación: {{$habitacion->ubicacion}}</p>
               
          </div>
            <p>{{Str::words(strip_tags($habitacion->descripcion),20,'...')}}</p>
            <a href="{{route('habitaciones.show',['habitacion'=> $habitacion->id])}}" class="btn btn-primary d-block font-weight-bold text-uppercase">Ver Publicación</a>
        </div>
    </div>

</div>
@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css" integrity="sha512-494Ejp/5WyoRNfh+nPLhSCQPHhcsbA5PoIGv2/FuEo+QLfW+L7JQGPdh8Qy2ZOmkF27pyYlALrxteMiKau1tyw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('botones')
     <a href="{{route('habitaciones.index')}}" class="btn btn-outline-primary mr-2 text-uppercase font-weight-bold"> 
        <svg class="icono" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
          </svg>
        Volver</a>
@endsection

@section('content')
<h2 class="text-center mb-5">Crear nueva publicación</h2>
  <div class="row justify-content-center mt-5">
      <div class="col-md-8">
           <form method="POST" action="{{route('habitaciones.store')}}" enctype="multipart/form-data" novalidate>
               @csrf
               <div class="form-group">
                   <label for="titulo">Titulo de la Publicación</label>

                   <input type="text"
                          name="titulo"
                          class="form-control @error('titulo') is-invalid @enderror" 
                          id="titulo"
                          placeholder="Titulo Publicacion"
                          value={{old('titulo')}}
                    >

                    @error('titulo')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
               </div>

               <div class="from-group">
                   <label for="categoria">Categoria</label>
                   <select
                        name="categoria"
                        class="form-control @error('categoria') is-invalid @enderror"
                        id="categoria"
                    >
                       <option value="">-- Seleccione --</option>
                       @foreach($categorias as $categoria)
                          <option value="{{$categoria->id}}" 
                          {{old('categoria') == $categoria->id ? 'selected' : ''}}>{{$categoria->nombre}}</option>
                       @endforeach
                   </select>

                   @error('categoria')
                      <span class="invalid-feedback d-block" role="alert">
                       <strong>{{$message}}</strong>
                      </span>
                   @enderror
               </div>

               <div class="form-group">
                <label for="precio">Precio del arriendo por mes en dolares</label>

                <input type="number"
                       name="precio"
                       class="form-control @error('precio') is-invalid @enderror" 
                       id="precio"
                       placeholder="Precio arriendo"
                       value={{old('precio')}}
                 >

                 @error('precio')
                     <span class="invalid-feedback d-block" role="alert">
                         <strong>{{$message}}</strong>
                     </span>
                 @enderror
            </div>

            <div class="form-group">
                <label for="ubicacion">Ubicación del inmueble</label>

                <input type="text"
                       name="ubicacion"
                       class="form-control @error('ubicacion') is-invalid @enderror" 
                       id="ubicacion"
                       placeholder="Ubicacion del inmueble"
                       value={{old('ubicacion')}}
                 >

                 @error('ubicacion')
                     <span class="invalid-feedback d-block" role="alert">
                         <strong>{{$message}}</strong>
                     </span>
                 @enderror
            </div>

            <div class="form-group">
                <label for="callep">Calle Principal</label>

                <input type="text"
                       name="callep"
                       class="form-control @error('callep') is-invalid @enderror" 
                       id="callep"
                       placeholder="Calle principal"
                       value={{old('callep')}}
                 >

                 @error('callep')
                     <span class="invalid-feedback d-block" role="alert">
                         <strong>{{$message}}</strong>
                     </span>
                 @enderror
            </div>

            <div class="form-group">
                <label for="contacto">Colocar un numero telefonico/celular</label>

                <input type="text"
                       name="contacto"
                       class="form-control @error('contacto') is-invalid @enderror" 
                       id="contacto"
                       placeholder="Contacto"
                       value={{old('contacto')}}
                 >

                 @error('contacto')
                     <span class="invalid-feedback d-block" role="alert">
                         <strong>{{$message}}</strong>
                     </span>
                 @enderror
            </div>

            <div class="form-group mt-3">
                <label for="descripcion">Descripción del inmueble</label>

                <input type="hidden"
                       name="descripcion" 
                       id="descripcion"
                       value={{old('descripcion')}}
                 >
                 <trix-editor class="form-control @error('descripcion') is-invalid @enderror"  
                              input="descripcion"></trix-editor>

                 @error('descripcion')
                 <span class="invalid-feedback d-block" role="alert">
                     <strong>{{$message}}</strong>
                 </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="estado">Seleccionar el estado de la propiedad: </label>

                <select 
                    type="text"    
                    name="estado"
                    class="form-control @error('estado') is-invalid @enderror"
                    id="estado"
                    placeholder="estado"
                    value={{old('estado')}}
                >
                    
                    <option selected>Disponible</option>
                    <option>Arrendado</option>
                    
                </select>

                @error('estado')
                     <span class="invalid-feedback d-block" role="alert">
                         <strong>{{$message}}</strong>
                     </span>
                 @enderror
                 
            </div>

            <div class="form-group mt-3">
                <label for="Imagen">Elige la imagen</label>

                <input id="imagen"
                       type="file"
                       class="from-control @error('imagen') is-invalid @enderror"
                       name="imagen">

                       @error('imagen')
                       <span class="invalid-feedback d-block" role="alert">
                           <strong>{{$message}}</strong>
                       </span>
                      @enderror
            </div>

               <div class="form-group">
                   <input type="submit" class="btn btn-primary" value="Agregar Publicación"> 
               </div>
           </form>
      </div>
  </div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js" integrity="sha512-wEfICgx3CX6pCmTy6go+PmYVKDdi4KHhKKz5Xx/boKOZOtG7+rrm2fP7RUR2o4m/EbPdwbKWnP05dvj4uzoclA==" crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>
@endsection
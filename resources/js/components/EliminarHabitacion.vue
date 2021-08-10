<template>
      <input 
      type="submit" 
      class="btn btn-danger w-40" 
      value="Eliminar"
      @click="eliminarHabitacion">
</template>

<script>
    export default {
         props:['habitacionId'],
         methods: {
             eliminarHabitacion(){
                 this.$swal({
                     title: '¿Deseas eliminar esta publicación?',
                     text: "Una vez eliminada, no se puede recuperar",
                     icon: 'warning',
                     showCancelButton: true,
                     confirmButtonColor: '#3085d6',
                     cancelButtonColor: '#d33',
                     confirmButtonText: 'Si',
                     cancelButtonText: 'No'
                  }).then((result) => {
                   if (result.value) {
                       const params = {
                           id: this.habitacionId
                       }
                       axios.post(`/habitaciones/${this.habitacionId}`,{params, _method: 'delete'})
                            .then(respuesta=>{
                                this.$swal({
                                    title: 'Publicacion eliminada',
                                    text: 'Se eliminó la publicacion',
                                    icon: 'success',
                                });

                                //Eliminar publicacion del dom
                                this.$el.parentNode.parentNode.parentNode.removeChild(this.$el.parentNode.parentNode);
                            })
                            .catch(error => {
                                console.log(error)
                            })
                   }
                });
             }
         },
    }
</script>

<template>
         <div>
            <span class="like-btn" @click="likeHabitacion" :class="{'like-active': isActive}"></span>
            <p>{{cantidadLikes}} personas les gusto la publicación</p>
         </div>

</template>

<script>
export default {
    props: ['habitacionId','like','likes'],
    data: function() {
      return {
        isActive: this.like,
        totalLikes: this.likes
      }
    },
    methods: {
        likeHabitacion(){
          axios.post('/habitaciones/' + this.habitacionId)
             .then(respuesta=>{

               if(respuesta.data.attached.length > 0){
                 this.$data.totalLikes++;
               }else{
                 this.$data.totalLikes--;
               }

               this.isActive =!this.isActive
               
             })
             .catch(error=>{
                  if(error.response.status === 401){
                    window.location = '/register';
                  }
             }); 
        }
    },
    computed:{
      cantidadLikes: function(){
        return this.totalLikes
      }
    }
}
</script>

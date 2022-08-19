<template>
  <div class="container">
    <div class="row mt-3">
        <div class="col col-sm-12 col-lg-8">
            <h1>Agregar Lider</h1>
            <!--formulario para agregar un lider-->
            <form @submit.prevent="addLider">
                <div class="form-group">
                    <label for="nombre">Nombre y Apellido</label>
                    <input type="text" class="form-control" id="nombre" v-model="lider.nombre">
                </div>
                <div class="form-group">
                    <label for="usuario">usuario</label>
                    <input type="text" class="form-control" id="usuario" v-model="lider.usuario">
                </div>
                <div class="form-group">
                    <label for="clave">clave</label>
                    <input type="password" class="form-control" id="clave" v-model="lider.clave">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="rol" value="lider" hidden>
                </div>
                
                <button type="submit" class="btn btn-primary" id="enviar">Agregar</button>
            </form> 

        </div>

    </div>

  </div>
</template>

<script>
import axios from 'axios';
export default {
    data() {
        return {
            lider:{},
            url: import.meta.env.VITE_URL,
            usuario: sessionStorage.getItem('usuario'),

            
        }
    },
    methods: {
        addLider() {
            var datos = new FormData();
            datos.append('nombre', this.lider.nombre);
            datos.append('usuario', this.lider.usuario);
            datos.append('clave', this.lider.clave);
            datos.append('rol', 'lider');
            datos.append('accion', 'agregar-lider');

            axios.post(this.url, datos)
                .then(response => {
                    if(response.data.estado == 'ok'){
                        alert('Lider agregado correctamente');
                        this.$router.push('/admin');
                    }
                    else{
                        alert('Error al agregar lider');
                    }
                })
                .catch(error => {
                    console.log(error)
                })
        }
    },

    created(){
        if(this.usuario.rol != 'admin'){
            this.$router.push('/');
        }
    }

}
</script>

<style>

</style>
<template>
  <div class="container">
    <div class="row">
        <div class="col col-lg-8 col-sm-12">
            <table class="table table-striped">
                <th>fecha</th>
                <th>lider</th>
                <th>persona</th>
                <th>acciones</th>
                <tr v-for="consejeria in consejerias" :key="consejeria.id">
                <td>{{consejeria.fecha_solicitado}}</td>
                </tr>

            </table>


        </div>

    </div>

  </div>
</template>

<script>
import axios from 'axios';
export default {
    data(){
        return {
            url: import.meta.env.VITE_URL,
            usuario: '',
            consejerias: [],
            
        }       
    },
    methods:{
        getConsejerias(){
            axios.get(this.url + '?accion=consejerias')
                .then(response => {
                    console.log(response.data);
                    this.consejerias = response.data;
                    this.hayConsejerias = true;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        eliminarConsejeria(id){
            axios.get(this.url + '?accion=eliminar-consejeria&id=' + id)
                .then(response => {
                    console.log(response.data);
                    this.getConsejerias();
                })
                .catch(error => {
                    console.log(error);
                });
        }
    },
    mounted(){
        this.usuario = JSON.parse(sessionStorage.getItem('usuario'));
        if(this.usuario.rol != 'admin'){
            this.$router.push('/');
        };
        this.getConsejerias();
    }
    
    

}
</script>

<style>

</style>
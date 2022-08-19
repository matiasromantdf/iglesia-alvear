<template>
  <div class="container">
    <div class="row">
        <div class="col col-lg-8 col-sm-12">

            <h1>Lider: {{lider.nombre}}</h1>
            <table class="table table-stripped">
              <th>Nombre</th>
              <th>Apellido</th>
              <th></th>
              <tr v-for="persona in personas" :key="persona.id">
              <td>{{persona.nombre}}</td>
              <td>{{persona.apellido}}</td>
              <td><button class="btn btn-primary" @click="this.$router.push('/ver-persona/'+persona.id)">Ver</button></td>
              </tr>

            </table>
            

        </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      lider: {},
      url:import.meta.env.VITE_URL,
      personas: [],
    };
  },
  mounted() {
    axios.get(this.url+'?accion=listar-lider&id=' + this.$route.params.id)
      .then(response => {
        this.lider = response.data;
      });
      this.getPersonas();
  },
  methods: {
    getPersonas() {
      axios.get(this.url+'?accion=grupo-de-lider&id=' + this.$route.params.id)
        .then(response => {
          console.log(response.data);
          this.personas = response.data;
        });
    },
  
  },
  created() {
    var usuario = JSON.parse(sessionStorage.getItem('usuario'));
    if(usuario.id != this.$route.params.id){
      this.$router.push('/');
    }
   
  },
     


}


</script>

<style>

</style>
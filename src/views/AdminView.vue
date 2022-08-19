<template>
  <div class="container">
    <div class="row">
        <div class="col">

            <!-- bootstrap jumbotron-->
            <div class="jumbotron">
                <h1 class="display-4">Administración</h1>
                <hr class="my-4">
                <p>Acciones que puede realizar:.</p>
                <p class="lead">
                    <router-link to="/add-persona" class="btn btn-primary btn-lg m-1">Registrar una Persona</router-link>
                    <router-link to="/add-lider" class="btn btn-primary btn-lg m-1">Registrar un Lider</router-link>
                    <router-link to="/consejerias" class="btn btn-primary btn-lg m-1" v-if="hayConsejerias">Consejerías</router-link>
                </p>
            </div>
            <div id="tabla">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Edad</th>
                            <th>Lider</th>
                            <!-- <th>Acciones</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="persona in personas" :key="persona.id" >
                            <td>{{ persona.nombre }}</td>
                            <td>{{ persona.apellido }}</td>
                            <td>{{ persona.edad }}</td>
                            <td> <div v-if="persona.lider == null">
                                <select id="select_lideres">
                                    <option v-for="lider in lideres" :value="lider.id" :key="lider.id">{{lider.nombre}}</option>
                                </select>
                                <button @click="asignarLider(persona.id)" id="btn-asignar">Asignar</button>
                                </div>
                            {{persona.lider }}<!--si tiene un lider muestra el nombre-->
                            </td>
                            <!-- <td>
                                <router-link to="/about" class="btn btn-primary btn-md m-1">Editar</router-link>
                                <router-link to="/about" class="btn btn-primary btn-md m-1">Eliminar</router-link>
                            </td> -->
                        </tr>
                    </tbody>
                </table>

            </div>



        </div>

    </div>

  </div>
</template>

<script>
import axios from 'axios'
export default {
    data() {
        return {
            url: import.meta.env.VITE_URL,
            usuario: '',
            personas: [],
            lideres: [],
            hayConsejerias: false,

        }       

    },
    created() {
        this.usuario = JSON.parse(sessionStorage.getItem('usuario'));
        if(this.usuario.rol != 'admin'){
            this.$router.push('/');
        };
        this.getPersonas();
        this.getLideres();
        this.getConsejerias();

    },
    methods: {
        getPersonas() {
            axios.get(this.url + '?accion=listar-personas')
                .then(response => {
                    console.log(response.data);
                    this.personas = response.data;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        getLideres() {
            axios.get(this.url + '?accion=listar-lideres')
                .then(response => {
                    console.log(response.data);
                    this.lideres = response.data;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        asignarLider(id){
            $('#btn-asignar').attr('disabled', true);
            var lider = document.getElementById('select_lideres').value;
            console.log(lider);
            var datos = new FormData();
            datos.append('id', id);
            datos.append('lider', lider);
            datos.append('accion', 'asignar-lider');

            axios.post(this.url, datos)
                .then(response => {
                    console.log(response.data);
                    this.getPersonas();
                })
                .catch(error => {
                    console.log(error);
                });
        },
        getConsejerias(){
            this.hayConsejerias = true;
            axios.get(this.url + '?consejerias')
                .then(response => {
                    console.log(response.data);
                    if(response.data.length > 0){
                       this.hayConsejerias = true;
                    }
                    else{
                    }
                })
                .catch(error => {
                    console.log(error);
                });
        }
    },
    computed: {
       
    }

}
</script>

<style>

</style>
<template>
<div class="container">
    <div class="row p-5">
        <div class="col col-lg-6 col-sm-12">
            <h1>Agregar Persona a la BD</h1>
            <form @submit.prevent="addPersona">
                 <div class="form-group">
                    <label for="fecha_visita">Fecha Visita</label>
                    <input type="date" class="form-control" id="fecha_visita" v-model="persona.fecha_visita">
                </div>
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" v-model="persona.nombre">
                </div>
                <div class="form-group">
                    <label for="apellido">Apellido</label>
                    <input type="text" class="form-control" id="apellido" v-model="persona.apellido">
                </div>
                <div class="form-group">
                    <label for="edad">Edad</label>
                    <input type="number" class="form-control" id="edad" v-model="persona.edad">
                </div>
                 <div class="form-group">
                    <label for="direccion">Direccion</label>
                    <input type="text" class="form-control" id="direccion" v-model="persona.direccion">
                </div>
                <div class="form-group">
                    <label for="telefono">Telefono</label>
                    <input type="text" class="form-control" id="telefono" v-model="persona.telefono">
                </div>
                 <div class="form-group">
                    <label for="estado_civil">Estado Civil</label>
                    <input type="text" class="form-control" id="estado_civil" v-model="persona.estado_civil">
                </div>
                 <div class="form-group">
                    <label for="ocupacion">Ocupación</label>
                    <input type="text" class="form-control" id="ocupacion" v-model="persona.ocupacion">
                </div>
                 <div class="form-group">
                    <label for="motivo_visita">Motivo de la Vista</label>
                    <textarea class="form-control" id="motivo_visita" v-model="persona.motivo_visita"></textarea> 
                </div>
                <div class="form-group">
                    <label for="observaciones">Observaciones</label>
                    <textarea class="form-control" id="observaciones" v-model="persona.observaciones"></textarea> 
                </div>
                <div class="form-group">
                    <label for="lider">Lider</label>
                    <select class="form-control" id="lider" v-model="lider">
                        <option>Sin Asignar</option>
                        <option v-for="lider in lideres" :value="lider.id" :key="lider.id">{{lider.nombre}}</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" id="enviar">Agregar</button>
                <button class="btn btn-secondary m-3" @click="this.$router.push('/admin')">Volver</button>
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
            url: import.meta.env.VITE_URL,
            usuario: '',
            nombre: '',
            apellido: '',
            edad: '',
            lider: '',
            lideres: [],
            personas: [],
            persona: {},
        }
    },
    mounted() {
        this.getLideres();
        this.getPersonas();
    },
    methods: {
        addPersona() {

            $('#enviar').attr('disabled', true);

            var datos = new FormData();
            datos.append('nombre', this.persona.nombre);
            datos.append('apellido', this.persona.apellido);
            datos.append('edad', this.persona.edad);
            datos.append('lider', $('#lider').val());
            datos.append('direccion', this.persona.direccion);
            datos.append('estado_civil', this.persona.estado_civil);
            datos.append('ocupacion', this.persona.ocupacion);
            datos.append('telefono', this.persona.telefono);
            datos.append('motivo_visita', this.persona.motivo_visita);
            datos.append('accion', 'agregar-persona');
            datos.append('observaciones', this.persona.observaciones);
            datos.append('fecha_visita', this.persona.fecha_visita);



            axios.post(this.url,datos)
                .then(response => {
                   console.log(response.data);
                   if(response.data.estado == 'ok'){
                    alert('Persona agregada correctamente');
                    //redireccionar a la pagina de personas
                    this.$router.push('/admin');
                    
                   }
                   else{
                    $('#enviar').attr('disabled', false);
                    alert('Error al agregar persona');
                   }

                })
                .catch(error => {
                    console.log(error);
                });
        },
        getPersonas() {
            axios.get(this.url + '?listar-personas')
                .then(response => {
                    this.personas = response.data;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        getLideres() {
            axios.get(this.url + '?accion=listar-lideres')
                .then(response => {
                    this.lideres = response.data;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        asignarLider(id) {
            axios.put(this.url + '/personas/' + id, {
                lider: this.lider,
            })
                .then(response => {
                    this.getPersonas();
                })
                .catch(error => {
                    console.log(error);
                });
        }
    },


}
</script>

<style>

</style>
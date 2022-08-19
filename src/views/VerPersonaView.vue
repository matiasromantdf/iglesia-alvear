<template>
  <div class="container">
    <div class="row mt-3">
        <div class="col col-lg-6 col-sm-12">
            <!--formulario para editar la persona-->
            <div class="form">
                <form>
                    <label>nombre:</label>
                    <input type="text" v-model="persona.nombre" class="form-control">
                    <label>apellido:</label>
                    <input type="text" v-model="persona.apellido" class="form-control">
                    <label>edad:</label>
                    <input type="number" v-model="persona.edad" class="form-control">
                    <label>direccion:</label>
                    <input type="text" v-model="persona.direccion" class="form-control">
                    <label>telefono:</label>
                    <input type="text" v-model="persona.telefono" class="form-control">
                    <label>estado civil:</label>
                    <input type="text" v-model="persona.estado_civil" class="form-control">
                    <label>ocupacion:</label>
                    <input type="text" v-model="persona.ocupacion" class="form-control">
                    <label>motivo de la visita:</label>
                    <input v-model="persona.motivo_visita" class="form-control">
                    <label>observaciones:</label>
                    <textarea v-model="persona.observaciones" class="form-control"></textarea>
                    <br>
                    <button type="submit" class="btn btn-primary" id="enviar" @click.prevent="updatePersona">Actualizar</button>
                    <button class="btn btn-warning ml-3" @click.prevent="reAsignar">Re-Asignar</button>
                    <button class="btn btn-secondary" @click.prevent="volver">Volver</button>
                    <textarea class="form-control mt-3" id="motivo"></textarea>
                    <button id="consejeria" class="btn btn-primary" @click.prevent="consejeria">Consejería</button>    
                </form>
                <br>
                
            </div>

        </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
    data(){
        return{
        persona:{},
        url: import.meta.env.VITE_URL,
    }
},
created(){
    this.obtenerPersona();
},
methods:{
        updatePersona(){
            var datos = new FormData();
            datos.append('accion', 'update');
            datos.append('id', this.persona.id);
            datos.append('nombre', this.persona.nombre);
            datos.append('apellido', this.persona.apellido);
            datos.append('edad', this.persona.edad);
            datos.append('direccion', this.persona.direccion);
            datos.append('telefono', this.persona.telefono);
            datos.append('estado_civil', this.persona.estado_civil);
            datos.append('ocupacion', this.persona.ocupacion);
            datos.append('motivo_visita', this.persona.motivo_visita);
            datos.append('observaciones', this.persona.observaciones);

            axios.post(this.url,datos)
            .then(response=>{
                console.log(response);
                if(response.data.estado == 'ok'){
                    alert('Persona actualizada correctamente');
                }
                
            }).catch(error=>{
                console.log(error);
            });
        },
        obtenerPersona(){
            axios.get(this.url+'?accion=ver-persona&id='+this.$route.params.id)
            .then(response=>{
                this.persona = response.data;
            }).catch(error=>{
                console.log(error);
            });
        },
        reAsignar(){
            var lider = sessionStorage.getItem('usuario');
            lider = JSON.parse(lider);
            var datos = new FormData();
            datos.append('accion', 're-asignar');
            datos.append('id', this.persona.id);


            axios.post(this.url,datos).then(response=>{
                console.log(response);
                if(response.data.estado == 'ok'){
                    alert('Persona re-asignada correctamente');
                    this.$router.push('/lider/'+lider.id);
                }
            }).catch(error=>{
                console.log(error);
            });
        },
        volver(){
            this.$router.push('/lider/'+this.persona.lider);
        },
        consejeria(){
            var datos = new FormData();
            datos.append('accion', 'consejeria');
            datos.append('idPersona', this.persona.id);
            datos.append('motivo', document.getElementById('motivo').value);
            
            axios.post(this.url,datos).then(response=>{
                console.log(response);
                if(response.data.estado == 'ok'){
                    alert('Consejería enviada correctamente');
                    $('#consejeria').attr('disabled', true);
                    $('#motivo').val('');

                }
            }).catch(error=>{
                console.log(error);
            });
            


        }

    }

}
</script>

<style>

</style>
<template>
  <div class="container">
    <div class="row mt-3">
        <div class="col">
            <h1>Agregar Lider</h1>
            <!--formulario para agregar un lider-->
            <form @submit.prevent="addLider">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" v-model="lider.nombre">
                </div>
                <div class="form-group">
                    <label for="apellido">Apellido</label>
                    <input type="text" class="form-control" id="apellido" v-model="lider.apellido">
                </div>
                <div class="form-group">
                    <label for="telefono">Telefono</label>
                    <input type="text" class="form-control" id="telefono" v-model="lider.telefono">
                </div>
                <button type="submit" class="btn btn-primary" id="enviar">Agregar</button>
            </form> 

        </div>

    </div>

  </div>
</template>

<script>
export default {
    data() {
        return {
            lider:{}
            
        }
    },

}
</script>

<style>

</style>
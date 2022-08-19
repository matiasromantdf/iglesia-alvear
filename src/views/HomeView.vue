<script setup>
import { RouterLink, RouterView } from 'vue-router'

</script>

<template>

   <div class="container" v-if="usuario == ''">
    <!-- div para el login-->
    <div class="row">
      <div class="col-md-6 col border p-5 mt-2" id="login">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Iniciar Sesión</h3>
          </div>
          <div class="panel-body">
            <form role="form">
              <fieldset>
                <div class="form-group">
                  <input type="hidden" name="accion" value="login">
                  <input class="form-control" placeholder="Usuario" name="user" v-model="user" type="text" autofocus>
                </div>
                <div class="form-group">
                  <input class="form-control" placeholder="Contraseña" name="password" v-model="password" type="password" >
                </div>
                <div class="checkbox">
                  
                </div>
                <button type="submit" class="btn btn-lg btn-success btn-block" @click.prevent="login()" id="btn">Iniciar Sesión</button>
              </fieldset>
            </form>
          </div>
        </div>
      </div>
    </div>
    
   
      
  </div>
      
  

<router-view></router-view>
</template>

<style scoped>
#login{
  background-color: #f5f5f5;
}
</style>
<script>
import axios from 'axios'
export default {
  data() {
    return {
      usuario: '',
      user: '',
      password: '',
      url: import.meta.env.VITE_URL
    }
  },
  created() {
    
  },
  methods: {
    login() {

      $('#btn').attr('disabled', true);
      var datos = new FormData();
      datos.append('user', this.user);
      datos.append('password', this.password);
      datos.append('accion', 'login');
      
      axios.post(this.url, datos)
      .then(response => {
        console.log(response);
        if(response.data.estado == 'ok'){
          this.usuario = response.data.datos[0];
          alert('Bienvenido ' + this.usuario.rol);
          sessionStorage.setItem('usuario', JSON.stringify(this.usuario));
          if(this.usuario.rol == 'admin'){
            this.$router.push('/admin');
          }
          if(this.usuario.rol == 'lider'){
            this.$router.push('/lider/' + this.usuario.id);
          }
        }
        else{
          alert("usuario o contraseña incorrectos");
          $('#btn').attr('disabled', false);
        }

      })
      .catch(error => {
        console.log(error)
      })
    }
  }
  
}
</script>
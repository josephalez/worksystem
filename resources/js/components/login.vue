<template>
  <div class="fondo">
    <div class="degradado d-flex flex-column align-items-center justify-content-center">
      <div class="card">
        <div class="card-body p-3">
          <form class="text-white padding-form">
            <h4 class="title text-center">Login</h4>
            <div class="md-form">
              <i class="fas fa-user prefix" style="padding-top: 7px;"></i>
              <input type="text" id="inputIconEx2" class="form-control" v-model="username">
              <label for="inputIconEx2">User</label>
            </div>
            <div class="md-form">
              <i id="canico" class="fas fa-lock prefix" style="padding-top: 7px;"></i>
              <input @click="unlock" type="password" id="inputpas" class="form-control" v-model="password">
              <label for="inputpas">Password</label>
            </div>
            <div class="text-center py-4 mt-3">
              <button @click="SendUser" class="btn btn-primary" type="button">Log in</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import Store from './../store';
  export default {
    data(){
      return{
        username: null,
        password: null,
      }
    },
    methods:{
      async SendUser(){
        var usuario = {
          username: this.username,
          password: this.password
        }
        console.log(usuario);
        var request =  await Store.dispatch('core/login', usuario);
        if (request.success) {
          Store.state.currentuser =  request.data.user;
          //console.log(Store.state.currentuser);
          //context.commit('setData',{ key:'currentuser' , data: request.data.user });
          window.location.href = '/organization';
        }
      },
      unlock(){
        $('#canico').removeClass('fa-lock');
        $('#canico').addClass('fa-unlock');
      }
    }
  }
</script>

<style scoped>
  .fondo{
    min-height: 100vh;
    background-image: url('/Frontend/img/1.jpg');
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
  }
  .degradado{
    min-height: 100vh;
    background: rgb(0,0,0);
    background: linear-gradient(180deg, rgba(0,0,0,.86) 35%, rgba(48,48,48,.5) 100%);
  }
  .card{
    background: rgba(0,0,0,.7);
  }
  .card-body{
    width: 400px;
    height: 320px;
  }
  .md-form label,.md-form input{
    color: #fff;
  }
  .padding-form{
    margin: 10px;
    padding: 0px 30px;
  }
  .btn{
    padding: 10px 15px;
  }
</style>

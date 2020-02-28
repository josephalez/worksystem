<template>
  <div>
    <button @click="asistencia" id="boton" type="button" class="btn btn-success" :disabled="boton" >{{texto}}</button>
  </div>
</template>

<script>
  import Store from './../store';
  import DateHelper from './../helpers/DateHelper';
  export default {
    data(){
      return{
        texto: "Entrar",
        boton: false
      }
    },
    computed: {
      /*currentuser: {
        get() { return Store.getters['core/currentuser'] }
      }*/
    },
    mounted(){
      console.log("SECOND",Store.state.currentuser);
    },
    methods:{
      async asistencia(){
        console.log(this.currentuser);
        /*if(this.texto == "Entrar") {
          this.boton = true;
          this.texto = 'Espere...';
          var fecha = (DateHelper.newDate()).getDateComplete();
          var hora = (DateHelper.newDate()).getDateTime();
          console.log('fecha: ', fecha ,'hora: ', hora);
          var assistance = {
            office: 1,
            member: user.member,
            date: fecha,
            entry: hora
          }

          var request = await Store.dispatch('core/EntryAssistance', assistance);

          if (request.success){
            this.texto = "Salir";
            $('#boton').removeClass('btn-success');
            $('#boton').addClass('btn-danger');
          }else {
            this.texto = "Entrar";
          }
          this.boton = false;

        }else{
          this.boton = true;
          this.texto = 'Espere...';
          var fecha = (DateHelper.newDate()).getDateComplete();
          var hora = (DateHelper.newDate()).getDateTime();
          console.log('fecha: ', fecha ,'hora: ', hora)
          var assistance = {
            office: 1,
            member: user.member,
            date: fecha,
            leave: hora
          }
          var request = await Store.dispatch('core/LeaveAssistance', assistance);

          if (request.success){
            $('#boton').removeClass('btn-danger');
            $('#boton').addClass('btn-success');
            this.texto = "Entrar";
          }else {
            this.texto = "Salir";
          }
          this.boton = false;
        }*/
      }
    }
  }
</script>

<style scoped>

</style>

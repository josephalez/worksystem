<template>
  <div class="blue main">
    <div class="container-fluid">
      <p class="h1-responsive text-center text-white assist">ASSIST</p>
      <div class="card-header white border-radius-t">
          <div for="dias">Dia</div>
          <input class="border-none"  type="date" name="Dia" value="dias" id="dias" v-model="inputdate" @change="filter">
      </div>
      <div class="table-responsive border-radius-b">
        <table class="table table-borderless">
          <thead>
            <tr>
              <th>Miembro</th>
              <th class="text-center">Oficina</th>
              <th class="text-center">Entrada</th>
              <th class="text-center">Salida</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(assistance, index) in assistances" :key="index" class="text-center">
              <td>
                <div class="d-flex flex-row align-items-center">
                  <img class="imagen-persona mr-3" width="40px;" height="40px;" src='Frontend/img/persona.jpg' alt="">
                  <div class="Titulo">
                    {{assistance.member}}
                  </div>
                </div>
              </td>
              <td>{{assistance.office}}</td>
              <td>{{assistance.entry}}</td>
              <td v-if="assistance.leave == null" class="text-danger font-weight-bold">No Marcada</td>
              <td v-if="assistance.leave != null">{{assistance.leave}}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import Store from './../store';

export default {
  data(){
    return{
      inputdate: null
    }
  },
  async mounted() {

    Store.dispatch('core/fetchAssistances');

  },
  methods:{
    filter(){
      console.log(this.inputdate);
      var fecha = this.inputdate;
      if (fecha != null && fecha != '') {
        Store.dispatch('core/fetchAssistances', fecha);
      }else {
        console.log('No es una fecha');
      }
    }
  },
  computed: {
    assistances: {
      get() { return Store.getters['core/assistances'] }
    }
  }
}
</script>

<style scoped>
  .main{
    min-height: 100vh;
  }
  .assist{
    padding: 80px 0px 30px 0px;
  }
  .border-radius-b{
    background: #fff;
    border-bottom-left-radius: 3px;
    border-bottom-right-radius: 3px;
  }
  .border-radius-t{
    border-top-left-radius: 3px;
    border-top-right-radius: 3px;
  }
</style>

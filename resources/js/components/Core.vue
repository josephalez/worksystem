<template>
  <div class="container-fluid main">
    <p class="h1-responsive text-center text-white Worksystem">WORKSYSTEM</p>
    <div class="d-flex justify-content-end">
      <button type="button" data-toggle="modal" data-target="#añadir"
      @click="add(true)" class="btn btn-success boton-añadir mb-2">Añadir</button>
    </div>
    <modalcomponent @detalle="detalle" v-if="modaldetalle == true"/>
    <modaladd  @add="add" v-if="modaladd == true"/>
    <modalstatus/>
    <lista @lista="detalle"/>
  </div>
</template>

<script>
  export default {
    data(){
      return{
        modaldetalle: null,
        modaladd: null
      }
    },
    mounted() {

    },
    methods:{
      add(valor){
        this.modaladd = valor;
      },
      detalle(valor){
        this.modaldetalle = valor;
      },
    }
  }
</script>

<style scoped>
.boton-añadir{
  border-radius: 2px;
  font-size: 12px;
}
.main{
  min-height: 100vh;
  padding-bottom: 80px;
}
.btn{
  margin-right: 0px !important;
}
.Worksystem{
  padding-top: 80px;
}
</style>

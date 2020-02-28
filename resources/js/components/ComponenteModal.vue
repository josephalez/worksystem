<template>
  <div>
    <div class="modal modal-fullexpand fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">{{organization.title}}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"
            @click="$emit('add', false)">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body-1">
            <div class="d-flex alinear">
              <div class="d-flex contenedor-imagen-empresa justify-content-center">
                <img class="imagen-empresa-modal h-100" :src='organization.photo' alt="">
              </div>
              <div class="d-flex flex-column justify-content-start ml-3 contenedor-texto-descriptivo text-justify">
                <p class="texto-fuente-modal">
                  {{organization.long_desc}}
                </p>
                <p class="datos-empresa">
                  Email: {{organization.email}}
                </p>
                <p class="datos-empresa">
                  Telefono: {{organization.phone}}
                </p>
                <p class="datos-empresa">
                  Web: {{organization.web}}
                </p>
              </div>
            </div>
          </div>
          <div>
            <div class="titulo-miembro">
              <h5 class="modal-title" id="exampleModalLabel">Miembros</h5>
            </div>
            <ul class="alalista">
              <li class="text-lista" v-for="(n,index) in 6"  :key="index">
                <div class="btn hover-persona d-flex flex-row align-items-center">
                  <img class="imagen-persona mr-3" width="20px;" height="20px;" src='/Frontend/img/persona.jpg' alt="">
                  <div class="Titulo">
                    Persona
                    <div class="descripcion">
                      <em>Cargo</em>
                    </div>
                  </div>
                </div>
              </li>
            </ul>
          </div>
          <div class="modal-footer">
            <button class="btn btn-danger boton-estado" style="margin: 7px;" type="button" @click="RemoveOrganization(organization.id)">
              <i class="far fa-trash-alt"></i>
            </button>
            <button v-if="organization.estado == 1" data-toggle="modal" data-target="#centralModalSm" class="btn btn-danger boton-estado" type="button" name="button">
              Pendiente
            </button>
            <button v-if="organization.estado == 2" data-toggle="modal" data-target="#centralModalSm" class="btn btn-success boton-estado" type="button" name="button">
              Completado
            </button>
            <button v-if="organization.estado == 3" data-toggle="modal" data-target="#centralModalSm" class="btn btn-warning text-amarillo boton-estado" type="button" name="button">
              En Progreso
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Store from './../store';
  export default {
    mounted() {

    },
    methods:{
      async RemoveOrganization(id){
        console.log('En el Frontend:  ',id);
        var request = await Store.dispatch('core/deleteOrganizations', id);
        if(request.success){
          Store.dispatch('core/fetchOrganizations');
          this.$emit('detalle', false);
        }
      }
    },
    computed: {
      organization: {
        get() { return Store.getters['core/organization'] }
      }
    }
  }
</script>

<style scoped>
  .datos-empresa{
    padding: 2px;
    font-size: 13px;
    margin: 0px;
  }
  .titulo-miembro{
    padding: 5px 15px;
  }
  .hover-persona:hover{
    background: #ccc;
  }
  .alinear{
    flex-direction: row;
  }
  .boton-estado{
    font-size: 12px;
  }
  .btn{
    margin: 0px;
    padding: 7px 7px;
  }
  .btn-warning{
    color: #000;
  }
  .btn .Titulo{
    font-size: 10px;
  }
  .descripcion{
    font-size: 8px;
    color: #545454 !important;
  }
  .borde{
    border-top: 1px solid #000;
  }
  .contenedor-imagen-empresa{
    with: 30%;
    height: 100px;
  }
  .contenedor-texto-descriptivo{
    with: 70%;
  }
  .modal-body-1{
    padding: 15px 15px 0px 15px;
  }
  .texto-fuente-modal{
    font-size: 14px;
    font-weight: 400;
  }
  .modal-footer{
    border-top: none !important;;
  }
  @media screen and (max-width: 991px){
    .alinear{
      flex-direction: column;
    }
    .contenedor-texto-descriptivo{
      padding: 15px 0px;
      margin: 0px !important;
    }
  }
  @media screen and (max-width: 550px){
    .texto-fuente-modal{
      font-size: 14px;
    }
    .modal-fullexpand .modal-dialog {
      margin: 0px;
    }
    .modal-fullexpand .modal-content {
      width: 100vw;
    }
    .texto-fuente-modal{
      font-size: 12px;
    }
  }
</style>

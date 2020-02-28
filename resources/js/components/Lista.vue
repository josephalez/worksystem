<template>
  <div>
      <div class="main-card mb-3 card">
        <div class="card-header border-radius">Empresas
        </div>
        <div class="table-responsive">
          <table class="align-middle mb-0 table table-borderless table-striped">
            <thead>
              <tr>
                <th class="text-center desa">#</th>
                <th>Nombre</th>
                <th class="text-center desa">Estado</th>
                <th class="text-center">Accion</th>
              </tr>
            </thead>
            <tbody class="border-radius">
              <tr v-for="organization in organizations">
                <td class="text-center text-muted desa">#{{organization.id}}</td>
                <td>
                  <div class="d-flex flex-row align-items-center">
                    <img class="imagen-empresa mr-3" width="40px;" height="40px;" :src='organization.photo' alt="">
                    <div class="Titulo">
                      {{organization.title}}
                      <div class="descripcion">
                        <em>{{organization.short_desc}}</em>
                      </div>
                    </div>
                  </div>
                </td>
                <td class="text-center desa">
                  <div class="badge badge-success status border-radius" v-if="organization.estado == 2">
                    Completado
                  </div>

                  <div class="badge badge-warning status border-radius text-amarillo" v-if="organization.estado == 3">
                    En progreso
                  </div>

                  <div class="border-radius badge badge-danger status" v-if="organization.estado == 1">
                    Pendiente
                  </div>
                </td>
                <td class="text-center">
                  <button type="button" @click="sendToModal(organization.id,organization.title, organization.photo, organization.long_desc, organization.estado, organization.web,
                  organization.email, organization.phone)"
                  data-toggle="modal" data-target="#basicExampleModal"
                  class="border-radius btn btn-primary btn-sm">
                    <i class="fas fa-search ico-details"></i><span class="desa">Detalles</span>
                  </button>
                </td>
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
    async mounted() {

      Store.dispatch('core/fetchOrganizations');

    },
    methods:{
      sendToModal(id,title, photo, long_desc, estado, web, email, phone){
        this.$emit('lista', true);
        var information = {id,title, photo, long_desc, estado, web, email, phone};
        Store.dispatch('core/fetchOrganization', information);
      }
    },
    computed: {
      organizations: {
        get() { return Store.getters['core/organizations'] }
      }
    }
  }

</script>

<style scoped>
.ico-details{
  display: none;
}
.status{
  display: block !important;
  margin-top: 10px;
  font-size: 13px;
}
.titulo{
  font-size: 18px;
}
.descripcion{
  font-size: 12px;
  color: #545454 !important;
}
.text-amarillo{
  color: #000 !important;
}
.border-radius{
  border-radius: 2px;
}
@media screen and (max-width: 550px){
  .ico-details{
    display: block;
  }
  .badge{
    display: none !important;
  }
  .desa{
    display: none !important;
  }
}
</style>

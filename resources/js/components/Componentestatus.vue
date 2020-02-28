<template>
  <div class="modal fade fond" id="centralModalSm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title w-100" id="myModalLabel">Estados</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body d-flex justify-content-center aling-items-center">
          <div class="btn-group-vertical" role="group" aria-label="Vertical button group">
            <button type="button" class="btn btn-danger" @click="change(organization.id, 1)">Pendiente</button>
            <button type="button" class="btn btn-warning" @click="change(organization.id, 3)">En progreso</button>
            <button type="button" class="btn btn-success" @click="change(organization.id, 2)">Completado</button>
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
      async change(id, estado){
        var formData = {
          id,
          estado
        }
        var request = await Store.dispatch('core/OrganizationState', formData);
        if (request.success) {
          window.location.reload();
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
  .fond{
    background: rgba(15,131,211, .8);
  }
  .btn-warning{
    color: #000;
  }
</style>

<template>
  <div>
    <div class="modal-fullexpand modal fade fond" id="añadir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title d-flex justify-content-center" id="exampleModalLabel">Nueva organizacion</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"
            @click="$emit('add', false)">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <template v-if="this.error">
            <template v-for="(error,index) in errors" :index="index">
              <div class="alert alert-danger alert-dismissible fade show" v-for="(errorDetail,index2) in error" :index="index2" role="alert" >
                {{ errorDetail }}
              </div>
            </template>
          </template>
          <div class="modal-body">
            <div class="px-lg-5 pt-0">
              <form class="text-center" style="color: #757575;">
                <div class="d-flex flex-row justify-content-between">
                  <div class="md-form mt-3">
                    <input type="text" id="materialContactFormName" class="form-control" v-model="title">
                    <label for="materialContactFormName">Nombre</label>
                  </div>
                  <div class="md-form mt-3">
                    <input type="email" id="materialContactFormName" class="form-control" v-model="email">
                    <label for="materialContactFormName">Email</label>
                  </div>
                  <div class="md-form mt-3">
                    <input type="text" id="materialContactFormName" class="form-control" v-model="phone">
                    <label for="materialContactFormName">Telefono</label>
                  </div>
                </div>
                <div class="d-flex flex-row justify-content-between">
                  <div class="md-form mt-3">
                    <input type="text" id="materialContactFormName" class="form-control" v-model="short_desc">
                    <label for="materialContactFormName">Decripcion corta</label>
                  </div>
                  <div class="md-form mt-3">
                    <input type="email" id="materialContactFormName" class="form-control" v-model="web">
                    <label for="materialContactFormName">Web</label>
                  </div>
                </div>
                <photo-input @load="newImage" defaultPhoto="Frontend/img/icoEmpresa.png" />
                <div class="md-form">
                  <textarea id="materialContactFormMessage" class="form-control md-textarea" rows="3" v-model="long_desc"></textarea>
                  <label for="materialContactFormMessage">Descripcion larga</label>
                </div>
                <button type="button" @click="SendInformation" class="btn btn-primary btn-lg btn-rounded btn-block z-depth-0 my-4 waves-effect">Guardar</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

  import Store from './../store';
  import PhotoInput from './formsComponents/PhotoInput';

  export default {
    data(){

      return{
        title: null,
        short_desc: null,
        long_desc: null,
        email: null,
        phone: null,
        photo: null,
        web: null,
        errors: false,
        error: false
      }
    },
    mounted() {

    },
    methods:{
      newImage(file){
            this.photo = file;
      },
      async SendInformation(){

        this.error = false;
        var formData =  new FormData();

        const data = {
          title: this.title,
          short_desc: this.short_desc,
          long_desc: this.long_desc,
          email: this.email,
          photo: this.photo,
          phone: this.phone,
          web: this.web,
        };

        //console.log("!----",data)

        for (let key in data) if (data[key]) formData.append(key, data[key]);

        //console.log("a",formData)

        var request = await Store.dispatch('core/NewOrganizations', formData);

        if (!request.success) {
          this.error = true;
          const rdata = request.data;
          this.errors =
            (typeof rdata == 'string') ? [[rdata]] : (typeof rdata[Object.keys(rdata)[0]] == 'string') ? [rdata] : rdata; //[''] [['']]  ''

          console.log(this.errors);
        }else{
          //AQUI HAZ QUE SE CIERRE EL MODAL ANDRES
          Store.dispatch('core/fetchOrganizations');
          this.$emit('add', false);
        }

      }
    },
    components: {
      'photo-input': PhotoInput
    }
  }
</script>

<style scoped>
  .alert{
    border-radius: 0px;
  }
  .md-form textarea.md-textarea{
    padding: 0px;
  }
</style>

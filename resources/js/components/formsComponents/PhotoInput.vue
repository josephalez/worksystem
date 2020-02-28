<template>
  <div class="file-field">
    <div class="mb-4">
      <img :src="preview" class="rounded-circle z-depth-1-half avatar-pic" alt="example placeholder avatar">
    </div>
    <div class="d-flex justify-content-center">
      <label class="btn btn-primary btn-rounded">
        Añadir foto
        <file-input styleInput="display: none;" @load="newImage" />
      </label>
    </div>
  </div>
</template>

<script>

  import FileInput from './FileInput';

  export default {
    data(){
      return{
        preview: null,
      }
    },
    mounted(){
      if (this.defaultPhoto)
        this.preview = this.defaultPhoto;
    },
    props: ['defaultPhoto'],
    methods:{
      newImage(file){
          this.preview = URL.createObjectURL(file);
          this.$emit("load", file);
      }
    },
    components: {
      'file-input': FileInput
    }
  }
</script>

<style scoped>

  .avatar-pic {
    width: 100px;
    height: 100px;
  }

</style>

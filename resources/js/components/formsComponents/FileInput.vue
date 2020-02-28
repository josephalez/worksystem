<template>
    <input :style="styleInput" type="file" @change="loadFromFile">
</template>

<script>

export default {
  methods: {
    loadFromFile(event){
      const file = event.target.files[0];
      this.$emit("load", file);
    }
  },
  props: ['styleInput']
};
</script>

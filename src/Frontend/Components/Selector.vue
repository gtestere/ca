<template>
  <select v-model="selected" @change="change" name="select">
    <option selected disabled value="">{{ placeholder }}</option>
    <option :key="option.id" v-for="option in options" :value="option.id">
      {{ option.name }}
    </option>
  </select>
</template>

<script lang="ts">
import Vue from 'vue';

export default Vue.extend({
  name: 'Navbar',
  props: {
    placeholder: {
      required: true,
      type: String
    },
    options: {
      required: true,
      type: Array
    }
  },
  data() {
    return {
      selected: ''
    }
  },
  methods: {
    change(Event:Event) {
      this.$emit('change', Event, this.selected)
    }
  }
});
</script>

<style scoped lang="scss">

</style>
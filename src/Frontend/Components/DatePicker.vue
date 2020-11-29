<template>
  <span class="date-picker">
    <div class="d-flex align-items-center">
      <span class="date-picker__label mr-3 ">
        {{ label }}
      </span>
    <datepicker v-model="date" @selected="change"></datepicker>
    </div>
  </span>
</template>

<script lang="ts">
import Vue from 'vue';
import moment from 'moment';

export default Vue.extend({
  name: 'DatePicker',
  props: {
    label: {
      type: String
    }
  },
  data() {
    return {
      date: null
    }
  },
  methods: {
    change(Date:Date) {
      this.$emit('change', moment(Date).format('YYYY-MM-DD'))
    }
  }
});
</script>

<style scoped lang="scss">
.app-wrapper {
  h1 {
    color: black;
  }
}
</style>
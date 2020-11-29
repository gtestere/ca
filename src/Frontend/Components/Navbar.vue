<template>
  <nav class="navbar">
    <div class="filter-wrapper p-4 d-flex flex-wrap justify-content-between w-100 border-dark border">
      <selector class="mb-3 mb-xl-0" @change="setHotel" ref="selector" :placeholder="'Select a hotel:'" :options="getHotels()"></selector>
      <date-picker class="mb-3 mb-xl-0" @change="setFrom" ref="from" :label="'FROM'"></date-picker>
      <date-picker class="mb-3 mb-xl-0" @change="setTo" ref="to" :label="'TO'"></date-picker>
    </div>
  </nav>
</template>

<script lang="ts">
import Vue from 'vue';
import {mapGetters, mapMutations} from 'vuex'
import DatePicker from "./DatePicker";
import Selector from "./Selector";
import axios from "axios";

export default Vue.extend({
  name: 'Navbar',
  components: {
    DatePicker,
    Selector
  },
  data() {
    return {
      params: {
        hotel: '',
        from: '',
        to: ''
      }
    }
  },
  watch: {
    params: {
      handler: function () {
        for (let key in this.params) {
          if (this.params[key] == "") {
            return false
          }
        }
        this.performCall()
      },
      deep: true
    }
  },
  methods: {
    setFrom($event:string) {
      this.params.from = $event
    },
    setTo($event:string) {
      this.params.to = $event
    },
    setHotel($event:Event, hotel:string) {
      this.params.hotel = hotel
    },
    performCall() {
      axios
          .get('api/' + this.params['hotel'] + '/' + this.params['from'] + '/' + this.params['to'])
          .then(response => {
            this.setReviews(response.data['data'])
            this.setInterval(response.data['interval'])
            this.setApiCalled()
          } )
    },
    setReviews(reviews:[]) {
      this.$store.commit('setReviews', reviews)
    },
    setInterval(interval:string) {
      this.$store.commit('setInterval', interval)
    },
    ...mapGetters(['getHotels']),
    ...mapMutations(['setApiCalled'])
  }
});
</script>
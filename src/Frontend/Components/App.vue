<template>
  <main class="app-wrapper pt-4">
    <div class="container">
      <div class="row">
        <div class="col-md-10 col-lg-8 mx-auto">
          <navbar></navbar>
        </div>
      </div>
      <h1 class="text-center my-4">
        Average score over time
      </h1>
      <chart v-if="chartData.length" :options="options" :data="chartData" :labels="labels"></chart>
      <p class="text-center text-primary" v-if="!chartData.length && getApiCalled()">
        No results were found, please select other combinations
      </p>
    </div>
  </main>
</template>

<script lang="ts">
import Vue from 'vue';
import {mapGetters, mapMutations} from 'vuex'
import Navbar from "./Navbar";
import Chart from "./Chart";
import axios from "axios";


export default Vue.extend({
  name: 'App',
  components: {
    Navbar,
    Chart
  },
  computed: {
    options() {
      const that = this
      const data = {
        legend: {
          display: false
        },
        tooltips: {
          enabled: true,
          callbacks: {
            title: function() {},
            label: ((tooltipItems :any, data :any) => {
              let ret  = []
              let count = data.datasets[tooltipItems.datasetIndex]['data'][tooltipItems.index].count;
              ret.push('Score:' + tooltipItems.yLabel)
              ret.push('Count:' + count)
              return ret
            })
          }
        },
        scales: {
          yAxes: [{
            scaleLabel: {
              display: true,
              labelString: 'Ratio'
            }
          }],
          xAxes: [{
            scaleLabel: {
              display: true,
              labelString: !this.getInterval() ? 'Date' : this.getInterval()
            }
          }]
        }
      }
      return data
    },
    labels() {
      let arr: string[] = []
      this.getReviews().forEach(function (a: string) {
        arr.push(a['date_group'])
      })
      return arr
    },
    chartData() {
      let arr: object[] = []
      this.getReviews().forEach(function (a: string) {
        arr.push({y: parseFloat(a['score']).toFixed(0), count: a['review_count']})
      })
      return arr
    }
  },
  mounted() {
    axios
        .get('api/getHotels')
        .then(response => (this.setHotels(response.data)))
  },
  methods: {
    ...mapMutations(['setHotels']),
    ...mapGetters(['getReviews', 'getInterval', 'getApiCalled'])
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
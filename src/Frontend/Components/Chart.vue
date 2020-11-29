<template>
  <canvas id="line" />
</template>

<script lang="ts">
import { Component, Prop, Watch, Vue } from 'vue-property-decorator'
import Chart from 'chart.js'

@Component
export default class LineChart extends Vue {
  @Prop({ default: function () { return []} }) readonly labels!: Array<string>
  @Prop({ default: function () { return []}  }) readonly colors!: Array<string>
  @Prop({ default: function () { return []}  }) readonly data!: Array<number>
  @Prop({
    default: () => {
      return Chart.defaults.line
    }
  })
  readonly options: object | undefined

  @Watch('data', {deep:true})
  dataChanged() {
    this.createChart({
      datasets: [
        {
          data: this.data,
          fill: false,
          backgroundColor: this.colors
        }
      ],
      labels: this.labels
    })
  }

  mounted() {
    this.createChart({
      datasets: [
        {
          data: this.data,
          fill: false,
          backgroundColor: this.colors
        }
      ],
      labels: this.labels
    })
  }

  createChart(chartData: object) {
    const canvas = document.getElementById('line') as HTMLCanvasElement
    const options = {
      type: 'line',
      data: chartData,
      options: this.options
    }
    new Chart(canvas, options)
  }
}
</script>